<?php
/**
 * Created by PhpStorm.
 * User: tuhx
 * Date: 2019/4/9
 * Time: 10:03
 */

namespace cncn\insurance\common;


interface InsuranceBaseInterface
{
    //投保
    public function booking($params);
    //撤保/退保
    public function cancel($params);
    //下载保单
    public function download($params);
    //团单人员批改
    public function endorseChange($params);
}