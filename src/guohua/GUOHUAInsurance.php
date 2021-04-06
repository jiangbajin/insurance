<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/10/27
 * Time: 14:18
 */
namespace cncn\insurance\guohua;

use cncn\insurance\common\InsuranceBaseInterface;
use cncn\insurance\common\InsuranceException;
use cncn\insurance\guohua\service\BatchBooking;
use cncn\insurance\guohua\service\BatchCancel;
use cncn\insurance\guohua\service\Booking;
use cncn\insurance\guohua\service\Cancel;
use cncn\insurance\guohua\service\Notify;
use cncn\insurance\guohua\service\Product;

class GUOHUAInsurance implements InsuranceBaseInterface
{

    protected $logObj = null;
    protected $config = null;
    public function __construct($config, $logObj = null)
    {
        $this->config = $config;
        $this->logObj = $logObj;
    }

    /**
     * @param $options
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function synProducts($options)
    {
        $service = new Product($this->config, $this->logObj);
        return $service->request($options);
    }

    /**
     * 投保
     * @param $options
     * @return mixed
     */
    public function booking($options)
    {
        $service = new Booking($this->config, $this->logObj);
        return $service->request($options);
    }

    /**
     * 多网络线程批量投保
     * @param $options
     * @return |null
     */
    public function batchBooking($options)
    {
        $service = new BatchBooking($this->config, $this->logObj);
        return $service->request($options);
    }

    /**
     * 撤保/退保
     * @param $options
     * @return mixed
     */
    public function cancel($options)
    {
        $service = new Cancel($this->config, $this->logObj);

        return $service->request($options);
    }

    /**
     * 多网络线程投保
     * @param $options
     * @return |null
     */
    public function batchCancel($options)
    {
        $service = new BatchCancel($this->config, $this->logObj);

        return $service->request($options);
    }

    /**
     * 国华人寿不能直接下载保单，必须登陆到他们的官网，进行下载，这里就直接进行跳转就好了
     * 下载保单
     * @param $options
     */
    public function download($options)
    {
        header('Location:https://www.95549.cn/pages/service/policyquery.shtml');
    }

    /**
     * @return Notify
     */
    public function notify()
    {
        return new Notify($this->logObj);
    }

    /**
     * 团单人员批改
     * @param $options
     */
    public function endorseChange($options)
    {
        throw new InsuranceException('当前方法不可用');
    }
}