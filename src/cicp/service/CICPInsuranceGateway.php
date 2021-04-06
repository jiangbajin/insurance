<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/12/10
 * Time: 11:08
 */
namespace cncn\insurance\cicp\service;

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
 * Class CICPInsuranceGateway
 * @package cncn\insurance\cicp\service
 */
abstract class CICPInsuranceGateway extends BaseInsuranceGateWay
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
     * 测试网关地址
     * @var string
     */
    protected $gateway = 'http://61.138.246.87:6001/NLifeServiceST';

    /**
     * @var null
     */
    private $data = null;


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

        //沙盒模式使用测试地址，非沙盒模式，使用config传入的网关地址
        if(!$config['debug']) {
            $this->gateway = rtrim($this->userConfig->get('api_url'), '/') . '/';
        }

        $this->config = [
            'GW_CH_CODE' => $this->userConfig->get('GW_CH_CODE') ?? '',
            'GW_CH_USER' => $this->userConfig->get('GW_CH_USER') ?? '',
            'GW_CH_PWD'  => $this->userConfig->get('GW_CH_PWD') ?? '',
        ];

        if(empty($this->gateway)){
            throw new InsuranceException('中华财险网关配置为空！');
        }

        if(empty($this->config['GW_CH_CODE'])){
            throw new InsuranceException('中华财险合作伙伴代码配置为空！');
        }

        if(empty($this->config['GW_CH_USER'])){
            throw new InsuranceException('中华财险用户名配置为空！');
        }

        if(empty($this->config['GW_CH_PWD'])){
            throw new InsuranceException('中华财险密码配置为空！');
        }
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
     * 处理提交body
     * @param array $data
     * @return array
     */
    abstract protected function dealRequestBody($data = []);

    /**
     * 单线程请求
     * @param array $options
     * @return |null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(array $options)
    {
        //开始报文分隔符
        $this->addLog(str_pad($this->getMethod() . ' Start', 100, '=', STR_PAD_BOTH));
        //结束报文分隔符
        $endLineStr = str_pad($this->getMethod() . ' End', 100, '=', STR_PAD_BOTH);

        try {
            $this->checkOptions($options);
        }catch (\Exception $e){
            $this->addLog("paramCheckError:{$e->getMessage()}");
            $this->addLog($endLineStr);
            throw new InsuranceException($e->getMessage());
        }

        //body xml报文详情
        $xml = $this->dealRequestBody($options);

        //整体请求体
        $params = [
            'headers' => [
                'Content-Type' => 'text/xml;charset=GBK',
                'GW_CH_TX'     => $this->getService(),
                'GW_CH_CODE'   => $this->config['GW_CH_CODE'],
                'GW_CH_USER'   => $this->config['GW_CH_USER'],
                'GW_CH_PWD'    => $this->config['GW_CH_PWD'],
            ],
            'body'    => $xml,
        ];
        $this->addLog("requestApiUrl:" . $this->gateway);
        $this->addLog("requestData:" . var_export($params, true));

        //xml UTF-8编码必须转成gbk
        $params['body'] = iconv('UTF-8',"gbk//IGNORE",$xml);

        try {
            $client   = new Client(['base_uri' => $this->gateway, 'timeout' => 90, 'verify' => false]);
            $result   = $client->request('POST', '', $params);
            $response = $result->getBody()->getContents();
            //获取的gbk报文必须转为utf8报文
            $response = iconv('gbk', "UTF-8//IGNORE", $response);
            //必须替换掉encoding=GBK的编码声明，否则simplexml_load_string会报错
            $response = str_replace('encoding="GBK"', 'encoding="UTF-8"', $response);
            $xmlObj   = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
            //转换为数组
            $responseArr = json_decode(json_encode($xmlObj, JSON_UNESCAPED_UNICODE), true);
            $this->addLog("responseXML:" . $response);
            $this->addLog("responseArr:" . var_export($responseArr, true));
            //报文分隔符
            $this->addLog($endLineStr);
            return $responseArr;
        }catch (RequestException $e){
            $this->addLog('网络问题'. $e->getMessage());
            $this->addLog($endLineStr);
            throw new InsuranceException('网络问题' . $e->getMessage());
        }
    }
}