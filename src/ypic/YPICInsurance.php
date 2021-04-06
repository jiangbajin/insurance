<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 15:59
 */
namespace cncn\insurance\ypic;


use cncn\insurance\common\InsuranceBaseInterface;
use cncn\insurance\common\InsuranceException;
use cncn\insurance\ypic\service\Booking;
use cncn\insurance\ypic\service\Cancel;
use cncn\insurance\ypic\service\Download;

class YPICInsurance implements InsuranceBaseInterface
{
    protected $config = null;
    public function __construct($config)
    {
        $this->config = $config;
    }

    //投保
    public function booking($options)
    {
        $service = new Booking($this->config);
        return $service->request($options);
    }

    public function multiBooking($options)
    {
        $service = new Booking($this->config);
        return $service->multiRequest($options);
    }

    //撤保/退保
    public function cancel($options)
    {
        $service = new Cancel($this->config);

        return $service->request($options);
    }

    //下载保单
    public function download($options)
    {
        $service = new Download($this->config);
        return $service->request($options);
    }

    //团单人员批改
    public function endorseChange($options)
    {
        throw new InsuranceException('当前方法不可用');
    }
}