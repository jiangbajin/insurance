<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/12/11
 * Time: 17:28
 */
namespace cncn\insurance\cicp\service;

use cncn\insurance\common\BaseInsuranceGateWay;
use cncn\insurance\common\InsuranceException;

/**
 * SDK对外提供的日志模块
 * Class Logger
 * @package cncn\insurance\cicp\service
 */
class Logger extends BaseInsuranceGateWay
{
    public function __construct($logObj = null)
    {
        parent::__construct($logObj);
    }
}