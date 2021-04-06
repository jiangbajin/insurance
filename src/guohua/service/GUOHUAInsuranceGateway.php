<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 15:37
 */
namespace cncn\insurance\guohua\service;

use cncn\insurance\common\BaseInsuranceGateWay;
use cncn\insurance\common\Config;
use cncn\insurance\common\InsuranceException;
use \Psr\Http\Message\ResponseInterface;
use \GuzzleHttp\Exception\RequestException;
use \GuzzleHttp\Exception\ClientException;
use cncn\foundation\traits\ObjectLoggingTrait;
use cncn\foundation\util\Aes;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;

/**
 * Class BBCInsuranceGateway
 * @package cncn\insurance\ccb
 */
abstract class GUOHUAInsuranceGateway extends BaseInsuranceGateWay
{
    /**
     * 全局配置参数
     * @var array
     */
    protected $config;

    /**
     * 用户定义配置
     * @var Config
     */
    protected $userConfig;

    /**
     * @var Client 
     */
    protected $client;

    /**
     * 正式网关地址
     * @var string
     */
    protected $gateway = 'http://hht.baoliantianxia.com:8068/sshtravel/lyx/';

    /**
     * @var null
     */
    private $data = null;

    /**
     * @var null
     */
    private $returnData = null;

    /**
     * 线程多批量返回
     * @var array
     */
    public $multiResult = [];

    /**
     * BBCInsuranceGateway constructor.
     * @param array $config
     * @param null $logObj
     */
    public function __construct(array $config, $logObj = null)
    {
        date_default_timezone_set('Asia/Shanghai');
        ini_set('max_execution_time', 120);
        parent::__construct($logObj);

        $this->userConfig = new Config($config);

        $this->gateway = rtrim($this->userConfig->get('api_url'), '/') . '/';
        $this->config = [
            'MessageAccount' => $this->userConfig->get('MessageAccount'),
            'AgentCode'      => $this->userConfig->get('AgentCode') ?? '',
        ];

        if(empty($this->gateway)){
            throw new InsuranceException('国华人寿网关为空！');
        }

        if(empty($this->config['MessageAccount'])){
            throw new InsuranceException('国华人寿API账号未配置！');
        }


        $this->client = new Client(['base_uri' => $this->gateway, 'timeout'  => 120, 'verify' => false]);
    }

    /**
     * @return string
     */
    abstract protected function getMethod();

    /**
     * @return string
     */
    abstract protected function getService();

    /**
     * 参数校验
     * @param array $options
     * @return array
     */
    abstract protected function checkOptions(array $options = []);

    /**
     * 单线程请求
     * @param array $options
     * @return |null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(array $options)
    {
        $this->addLog("===========================================================================================================================");
        try {
            $options = $this->checkOptions($options);
        }catch (\Exception $e){
            $this->addLog("{$this->getMethod()}_paramCheckError:{$e->getMessage()}");
            throw new InsuranceException($e->getMessage());
        }
        $uri = $this->gateway . $this->getService() . '&MessageAccount=' . $this->config['MessageAccount'];
        //get uri参数组装
        $uri .= '&' . implode('&', array_map(function($k)use($options){return $k . '=' . $options[$k];}, array_keys($options)));
        $this->addLog("{$this->getMethod()}_requestUri:" . $uri);
        try {
            $res = $this->client->request('GET', $uri);
            $response = $res->getBody()->getContents();

            //返回的xml投会带GBK，必须替换成UTF-8，否则simplexml_load_string会得到false
            $response = str_replace('encoding="GBK"', 'encoding="UTF-8"', $response);
            $xmlObj = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->returnData = json_decode(json_encode($xmlObj, JSON_UNESCAPED_UNICODE),true);

            $this->addLog("{$this->getMethod()}_response:{$response}");
            $this->addLog("{$this->getMethod()}_responseArr:" . var_export($this->returnData, true));
        } catch (ClientException $e) {
            $this->returnData = "网络问题:{$e->getMessage()}";
            $this->addLog("{$this->getMethod()}_responseError:{$e->getMessage()}");
            throw new InsuranceException($this->returnData);
        }

        return $this->returnData;
    }


    public function mulRequest(array $options)
    {
        $this->addLog("===========================================================================================================================");
        try {
            $options = $this->checkOptions($options);
        }catch (\Exception $e){
            $this->addLog("{$this->getMethod()}_paramCheckError:{$e->getMessage()}");
            throw new InsuranceException($e->getMessage());
        }

        try {
            $client = $this->client;
            $requests = function ($options) use($client){
                foreach ($options as $key => $record){
                    yield function() use ($client, $record) {
                        $uri = $this->gateway . $this->getService() . '&MessageAccount=' . $this->config['MessageAccount'];
                        $uri .= '&' . implode('&', array_map(function($k)use($record){
                                if($k != 'id') {
                                    return $k . '=' . $record[$k];
                                }
                            }, array_keys($record)));
                        $this->addLog("{$this->getMethod()}_requestUri:" . $uri);
                        return $client->requestAsync('GET', $uri);
                    };
                }
            };

            $pool = new Pool($client, $requests($options), [
                'concurrency' => 10,//启用10个线程，以后太慢了再调大
                'fulfilled' => function (ResponseInterface $response, $index) use($options) {
                    $res = $response->getBody()->getContents();
                    //返回的xml投会带GBK，必须替换成UTF-8，否则simplexml_load_string会得到false
                    $res = str_replace('encoding="GBK"', 'encoding="UTF-8"', $res);
                    $xmlObj = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
                    $this->multiResult[$options[$index]['id']] = json_decode(json_encode($xmlObj, JSON_UNESCAPED_UNICODE),true);
                    $this->addLog("{$this->getMethod()}_response:{$res}");
                    $this->addLog("{$this->getMethod()}_responseArr:" . var_export($this->multiResult[$options[$index]['id']], true));
                },
                'rejected' => function (RequestException $reason, $index) use($options) {
                    //失败的就不处理了，下次继续同步就行了
                    $this->addLog('CURL错误：<br>'. $reason->getMessage());
                    $returnData['ErrorCode'] = 'CURL_ERROR';
                    $returnData['ReMark']    = '网络错误，返回CURL错误！';
                    $this->multiResult[$options[$index]['id']] = $returnData;
                },
            ]);
        } catch (ClientException $e) {
            $this->returnData = "网络问题:{$e->getMessage()}";
            $this->addLog("{$this->getMethod()}_responseError:{$e->getMessage()}");
            throw new InsuranceException($this->returnData);
        }

        $promise = $pool->promise();
        $promise->wait();
        return $this->multiResult;
    }
}
