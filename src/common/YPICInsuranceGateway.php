<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 15:37
 */
namespace cncn\insurance\common;

use \Psr\Http\Message\ResponseInterface;
use \GuzzleHttp\Exception\RequestException;
use \GuzzleHttp\Exception\ClientException;
use cncn\foundation\traits\ObjectLoggingTrait;
use cncn\foundation\util\Aes;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;

abstract class YPICInsuranceGateway
{
    use ObjectLoggingTrait;
    /**
     * 全局配置参数
     * @var array
     */
    protected $config;

    /**
     * 是否开启日志
     */
    protected $log = true;

    /**
     * 日志地址
     */
    protected $logPath = 'YPIC';

    /**
     * 用户定义配置
     * @var Config
     */
    protected $userConfig;

    protected $client;

    /**
     * 黄河财险正式网关地址
     * @var string
     */
    protected $gateway = 'http://223.71.98.124:8002/sp/resources/externalSer/';

    private $data = null;

    private $returnData = null;

    public function __construct(array $config)
    {
        date_default_timezone_set('Asia/Shanghai');

        $this->userConfig = new Config($config);
        if (empty($this->userConfig->get('key'))) {
            throw new InsuranceException('Missing Config -- 缺少保险秘钥');
        }

        $this->config = [
            'key'      => $this->userConfig->get('key'),
        ];

        // 沙盒模式
        if (!empty($config['debug'])) {
            $this->gateway = 'http://223.71.98.124:8002/sp/resources/externalSer/';
            $this->config = [
                'key'      => 'HHCXQDPTSTANDCHANNEL',
            ];
        }

        //如果key是 HHCXQDPTSTANDCHANNEL，那么也是沙盒模式
        if($this->config['key'] == 'HHCXQDPTSTANDCHANNEL'){
            $this->gateway = 'http://223.71.98.124:8002/sp/resources/externalSer/';
        }

        //是否关闭日志
        if(isset($config['log']) && $config['log'] == false){
            $this->log = false;
        }

        //日志地址
        if(isset($config['logPath']) && !empty($config['logPath'])){
            $this->logPath = $config['logPath'];
        }
        $this->client = new Client(['base_uri' => $this->gateway, 'timeout'  => 60, 'verify' => false]);

        $this->setLogger(\cncn\foundation\util\Logger::getInstance($this->logPath, '..'));
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
     * 多线程请求
     * @param array $options
     * @return array
     */
    public function multiRequest(array $options)
    {

        foreach($options as $key => $option) {
            try {
                $options[$key] = $this->checkOptions($option);
            }catch (\Exception $e){
                throw new InsuranceException('第' . $key . '份投保信息的' . $e->getMessage());
            }
        }

        $client = $this->client;
        $this->data = $options;
        $this->logInfo('=====================' . $this->getMethod() .'请求开始=========================');
        $requests = function ($options) use($client){
            foreach ($options as $key => $record){
                yield function() use ($client, $record) {
                    $data = [
                        'body'=> $this->encrypt(json_encode($record, JSON_UNESCAPED_UNICODE)),
                        'headers' => [
                            'content-type' => 'application/json',
                        ]
                    ];
                    $this->logInfo('请求明文：' . json_encode($record, JSON_UNESCAPED_UNICODE));
                    $this->logInfo('请求密文：' . $data['body']);
                    return $client->requestAsync('POST', $this->getService(), $data);
                };
            }
        };

        $pool = new Pool($client, $requests($options), [
            'concurrency' => 50,
            'fulfilled' => function (ResponseInterface $response, $index) {
                $response = $response->getBody()->getContents();
                $this->logInfo('回复密文：' . $response);
                $responseArr = $this->decrypt($response);
                $this->logInfo('回复明文：' . json_encode($responseArr, JSON_UNESCAPED_UNICODE));
                $this->returnData[$index] = $responseArr;
                //获取原始报文
                $originOption =  $this->data[$index];
                $this->logInfo($originOption['insured'][0]['name'] .',投保成功');
            },
            'rejected' => function (RequestException $reason, $index) {
                $this->returnData[$index] = $reason;
                //获取原始报文
                $originOption =  $this->data[$index];
                $this->logInfo('请求异常：' . $reason);
                $this->logInfo('网络问题：' . $reason . $originOption['insured'][0]['name'] .',投保失败');
            },
        ]);
        $promise = $pool->promise();
        $promise->wait();

        return $this->returnData;
    }

    /**
     * 单线程请求
     * @param array $options
     * @return null
     */
    public function request(array $options)
    {

        try {
            $options = $this->checkOptions($options);
        }catch (\Exception $e){
            throw new InsuranceException($e->getMessage());
        }

        $data = [
            'body'=> $this->encrypt(json_encode($options)),
            'headers' => [
                'content-type' => 'application/json',
            ]
        ];

        $this->logInfo('=====================' . $this->getMethod() .'请求开始=========================');
        $this->logInfo('请求明文：' . json_encode($options, JSON_UNESCAPED_UNICODE));
        $this->logInfo('请求密文：' . $data['body']);

        try {
            $promise = $this->client->requestAsync('POST', $this->getService(), $data);
            $promise->then(
                function (ResponseInterface $res) {
                    $response = $res->getBody();
                    $this->logInfo('回复密文：' . $response);
                    $responseArr = $this->decrypt($response);
                    $this->logInfo('回复明文：' . json_encode($responseArr, JSON_UNESCAPED_UNICODE));
                    $this->returnData = $responseArr;
                    $this->logInfo('=====================' . $this->getMethod() .'结束=========================');
                },
                function (RequestException $e) {
                    $this->logInfo('请求异常：' . $e->getMessage());
                    $this->returnData = '网络请求超时';
                    $this->logInfo('=====================' . $this->getMethod() .'结束=========================');
                    throw  new \RuntimeException($this->returnData);
                }
            )->wait();
        } catch (ClientException $e) {
            $this->logInfo('请求异常：' . $e->getRequest());
            $this->logInfo('请求异常：' . $e->getResponse());
            $this->logInfo('=====================' . $this->getMethod() .'结束=========================');
            throw new \RuntimeException($e->getMessage());
        }

        return $this->returnData;
    }


    /**
     * 判断日期字符串是否合法
     * 票付通规定日期必须是10位用两个"-"隔开的字符串
     * @param string $dateTimeStr
     * @return string
     */
    protected function checkDateTime($dateTimeStr = '2019-01-01 23:59:59')
    {
        if(strlen($dateTimeStr) != 19  || strtotime($dateTimeStr) === false){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 截止至201807已公布最新号段
     * 移动号段：134 135 136 137 138 139 147(上网卡) 148 150 151 152 157 158 159 172 178 182 183 184 187 188 198
     * 联通号段：130 131 132 145(上网卡) 146(4G) 155 156 166 171 175 176 185 186
     * 电信号段：133 149 153 173 174 177(4G) 180 181 189 199
     * 卫星通信：1349
     * 虚拟运营商：170
     * 验证是否是手机号
     * @param $mobile
     * @return bool
     */
    public function isMobileNo($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,6,7,8,9]{1}\d{8}$|^15[^4]{1}\d{8}$|^16[6]{1}\d{8}$|^17[^9]{1}\d{8}$|^18[\d]{9}$|^19[8,9]{1}\d{8}$#', $mobile) ? true : false;

    }

    /**
     * 参数校验
     * @param array $options
     * @return array
     */
    abstract protected function checkOptions(array $options = []);


    /**
     * @param string $raw
     * @return string
     */
    private function encrypt($raw = '')
    {
        $key = md5($this->config['key'],true);
        $aes = new Aes($key,"AES-128-CBC", $key);//黄河财险AES向量偏移量和是加密秘钥的md5
        return $aes->encryptBase64($raw);
    }

    /**
     * @param string $raw
     * @return mixed
     */
    private function decrypt($raw = '')
    {
        $key = md5($this->config['key'],true);
        $aes = new Aes($key,"AES-128-CBC", $key);//黄河财险AES向量偏移量和是加密秘钥的md5

        return json_decode($aes->decryptBase64($raw), true);
    }
}
