<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 16:08
 */

namespace cncn\insurance\ypic\service;

use cncn\insurance\common\InsuranceException;
use cncn\insurance\common\YPICInsuranceGateway;

class Cancel extends YPICInsuranceGateway
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
        return 'surrender';
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
        //参数校验
        if(!isset($options['policyNo']) || empty($options['policyNo'])){
            throw new InsuranceException('请输入要撤保的保单号');
        }

        //黄河保险是黄河根据旅控定制的，platform是特殊编号，这里都写死，
        //查询的transactionNo对外部业务无特殊帮助，每次操作唯一，这里定义在SDK内部
        //timeStamp也定义在SDK内部
        //requestType= 20 是约定的撤保类型，本类单一职责，直接写死20
        //唯一需要外部传入的是policyNo
        $data = [
            'head' =>
                [
                    'platform' => 'LKJ',
                    'requestType' => '20',
                    'transactionNo' => \cncn\foundation\util\UUIDGenerator::snumberNo20(),
                    'timeStamp' => date('Y-m-d H:i:s'),
                    'errorCode' => '0000',
                    'errorMsg' => '成功',
                ],
            'body' =>
                [
                    'policyNos' =>
                        [
                            0 =>
                                [
                                    'policyNo' => $options['policyNo'],
                                ],
                        ],
                ],
        ];

        return $data;
    }

}