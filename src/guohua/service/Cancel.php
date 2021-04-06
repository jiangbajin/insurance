<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 16:08
 */

namespace cncn\insurance\guohua\service;

use cncn\insurance\guohua\service\GUOHUAInsuranceGateway;
use cncn\insurance\common\InsuranceException;

class Cancel extends GUOHUAInsuranceGateway
{
    /**
     * 当前接口方法，便于登记日志使用
     * @return string
     */
    protected function getMethod()
    {
        return 'Cancel';
    }

    /**
     * 撤保接口地址
     * @return string
     */
    protected function getService()
    {
        return 'transferData_CreateOrder.action?MessageType=INSUCANCEL';
    }

    /**
     * 单线程请求撤保
     * @param array $options
     * @return null
     */
    public function request(array $options = [])
    {
        return parent::request($options);
    }

    /**
     * 撤保参数校验
     * @param array $options
     * @return array
     */
    protected function checkOptions(array $options = [])
    {
        //保单号
        if(empty($options['INSUNO'])){
            throw new InsuranceException('撤保保单号为空');
        }
        $data['INSUNO'] = trim($options['INSUNO']);

        //回调链接
        if(empty($options['RedirectUri'])){
            throw new InsuranceException('撤保回调链接为空');
        }
        $data['RedirectUri'] = trim($options['RedirectUri']);

        return $data;
    }

}