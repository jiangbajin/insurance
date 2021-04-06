<?php
/**
 * Created by PhpStorm.
 * User: tuhx
 * Date: 2019/4/9
 * Time: 10:19
 */

namespace cncn\insurance\common;


class CommonInsuranceType
{
    /**
     * 江泰保险
     */
    const INSURANCE_JT = 1;

    /**
     * 金城保险（东吴保险）
     */
    const INSURANCE_DW = 2;

    /**
     * 太平洋保险
     */
    const INSURANCE_CPIC = 3;

    /**
     * 人民保险
     */
    const INSURANCE_PICC = 4;

    /**
     * 黄河保险
     */
    const INSURANCE_YPIC = 5;

    /**
     * 至尊宝保险
     */
    const INSURANCE_ZZB = 6;

    /**
     * 中国人寿保险
     */
    const INSURANCE_CHINA_LIFE = 7;

    /**
     * 光大保险
     */
    const INSURANCE_SUN_LIFE = 8;

    /**
     * 保联天下保险-国华人寿
     */
    const INSURANCE_GUOHUA_LIFE_INSURANCE = 9;

    /**
     * 中华财险
     */
    const INSURANCE_CICP = 10;

    /**
     * 保险类型
     * @var array
     */
    public static $insuranceTypeList = [
        self::INSURANCE_YPIC                  => '黄河保险',
        self::INSURANCE_GUOHUA_LIFE_INSURANCE => '保联天下保险',
        self::INSURANCE_CICP                  => '中华财险',
    ];

    /**
     * 获取保险渠道号码
     * @return array
     * @throws \ReflectionException
     */
    public static function getInsuranceTypeMapByChannelName()
    {
        $objClass = new \ReflectionClass(__CLASS__);
        return $objClass->getConstants();
    }
}