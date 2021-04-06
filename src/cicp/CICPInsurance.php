<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/12/7
 * Time: 16:27
 */
namespace cncn\insurance\cicp;

use cncn\insurance\cicp\service\Booking;
use cncn\insurance\cicp\service\CaculatePremium;
use cncn\insurance\cicp\service\Cancel;
use cncn\insurance\cicp\service\EndorseChange;
use cncn\insurance\cicp\service\Logger;
use cncn\insurance\cicp\service\Query;
use cncn\insurance\common\InsuranceBaseInterface;
use cncn\insurance\common\InsuranceException;

class CICPInsurance implements InsuranceBaseInterface
{
    protected $logObj = null;
    protected $config = null;

    public function __construct($config, $logObj = null)
    {
        $this->config = $config;
        $this->logObj = $logObj;
    }


    /**
     * @return array
     */
    public function getSuccessStatus()
    {
        return ['00', '02'];
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
     * 下载保单
     * @param $options
     */
    public function download($options)
    {
        header('Location:' . $options['url']);
    }

    /**
     * 团单人员批改
     * @param $options
     */
    public function endorseChange($options)
    {
        return new EndorseChange($this->config, $this->logObj);
    }

    /**
     * 保单查询
     * @param options
     * @return Query
     */
    public function query()
    {
        return new Query($this->config, $this->logObj);
    }

    /**
     * 保费试算
     * @return CaculatePremium
     */
    public function cal()
    {
        return new CaculatePremium($this->config, $this->logObj);
    }

    /**
     * SDK对外提供日志句柄
     * @return Logger
     */
    public function logger()
    {
        return new Logger($this->logObj);
    }

}