<?php
/**
 * Created by IntelliJ IDEA.
 * User: nathena
 * Date: 2019/4/10 0010
 * Time: 17:56
 */

namespace cncn\insurance;


use cncn\insurance\common\CommonInsuranceType;
use cncn\insurance\common\InvalidInstanceException;

/**
 * Class PayFactory
 * @package \cncn\insurance
 * @method \cncn\insurance\ypic\YPICInsurance YPIC($config) static //黄河保险加载器
 * @method \cncn\insurance\guohua\GUOHUAInsurance GUOHUA($config, $logObj = null) static //国华人寿保险加载器
 * @method \cncn\insurance\cicp\CICPInsurance CICP($config,$logPath='') static //中华联合财产保险加载器
 */
class InsuranceFactory
{

    //定义匹配__callStatic自动加载方式匹配的命名
    /**
     * 黄河保险
     */
    const YPIC = 1;
    /**
     * 至尊宝保险
     */
    const ZZB = 2;

    /**
     * 国华人寿，保联天下保险
     */
    const GUOHUA = 3;

    /**
     * 中华财险，中华联合财产保险
     */
    const CICP = 4;

    /**
     * [
     *   'INSURANCE_BBC' => 3,
     * ...
     * ]
     * 保险类型
     * @return array
     * @throws \ReflectionException
     */
    public static function getInsuranceTypeMapById()
    {
        $objClass = new \ReflectionClass(__CLASS__);
        $constArr = $objClass->getConstants();
        return array_flip($constArr);
    }

    /**
     * @param $channelName
     * @param $arguments
     * @return mixed
     * @throws InvalidInstanceException
     * @throws \ReflectionException
     */
    public static function __callStatic($channelName, $arguments)
    {
        $channelList = array_values(self::getInsuranceTypeMapById());
        $insuranceTypeArrMapByChannelName = CommonInsuranceType::getInsuranceTypeMapByChannelName();
        $insuranceTypeMapByChannelName = array_keys($insuranceTypeArrMapByChannelName);
        if(in_array($channelName, $channelList)){
            $class = 'cncn\\insurance\\' . strtolower($channelName) . '\\' . strtoupper($channelName). 'Insurance';
        }

        if (!empty($class) && class_exists($class)) {
            $option = array_shift($arguments);
            $logObj = array_shift($arguments);
            $config = is_array($option) ? $option :[];
            return new $class($config, $logObj);
        }else{
            throw new InvalidInstanceException("Insurance class {$channelName} not found");
        }
    }
}