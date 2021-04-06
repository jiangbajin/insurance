<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/10/27
 * Time: 15:14
 */
namespace cncn\insurance\guohua\service;

use cncn\insurance\guohua\service\GUOHUAInsuranceGateway;
use cncn\insurance\common\InsuranceException;

/**
 * Class Product
 * @package cncn\insurance\ypic\service
 */
class Product extends GUOHUAInsuranceGateway
{
    /**
     * 当前接口方法，便于登记日志使用
     * @return string
     */
    protected function getMethod()
    {
        return 'Product';
    }

    /**
     * 同步产品接口服务地址
     * @return string
     */
    protected function getService()
    {
        return 'loadProduct_product.action?MessageType=PROD';
    }

    /**
     * 投保参数校验
     * @param array $options
     * @return array
     */
    protected function checkOptions(array $options = [])
    {
        //系统时间
        if(empty($options['MessageTime'])){
            throw new InsuranceException('系统时间为空');
        }
        $data['MessageTime'] = $options['MessageTime'];
        return $data;
    }

}
