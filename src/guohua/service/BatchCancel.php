<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/11/10
 * Time: 16:13
 */
namespace cncn\insurance\guohua\service;

use cncn\insurance\guohua\service\GUOHUAInsuranceGateway;
use cncn\insurance\common\InsuranceException;

class BatchCancel extends GUOHUAInsuranceGateway
{
    /**
     * 当前接口方法，便于登记日志使用
     * @return string
     */
    protected function getMethod()
    {
        return 'BatchCancel';
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
        return parent::mulRequest($options);
    }

    /**
     * 撤保参数校验
     * @param array $options
     * @return array
     */
    protected function checkOptions(array $options = [])
    {
        if(!$options){
            throw new InsuranceException('撤保参数为空');
        }

        $data = [];
        foreach($options as $option) {
            //保单号
            if (empty($option['INSUNO'])) {
                throw new InsuranceException('撤保保单号为空');
            }
            $tmp['INSUNO'] = trim($option['INSUNO']);

            //回调链接
            if (empty($option['RedirectUri'])) {
                throw new InsuranceException('撤保回调链接为空');
            }
            $tmp['RedirectUri'] = trim($option['RedirectUri']);
            $tmp['id'] = $option['id'];

            $data[] = $tmp;
            unset($tmp);
        }

        return $data;
    }

}