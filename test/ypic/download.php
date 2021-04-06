<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 17:42
 */
include '../../init.php';
// 加载配置参数
$config = require(__DIR__ . '/config.php');

$options = [
    'policyNo' => '662018811432019LKJ00000153',
];

//电子保单参数
//$options = array (
//    'head' =>
//        array (
//            'platform' => 'LKJ',
//            'requestType' => '30',
//            'transactionNo' => \cncn\foundation\util\UUIDGenerator::snumberNo20(),
//            'md5Value' => '',
//            'timeStamp' => date('Y-m-d H:i:s'),
//            'errorCode' => '0000',
//            'errorMsg' => '成功',
//        ),
//    'body' =>
//        array (
//            'insResults' =>
//                array (
//                    0 =>
//                        array (
//                            'policyNo' => '662018811432019LKJ00000153',
//                            'policyDownUrl ' => '',
//                            'errorCode' => '0000',
//                            'errorMsg' => '成功',
//                        ),
//                ),
//        ),
//);

try {
    $result = \cncn\insurance\InsuranceFactory::YPIC($config)->download($options);
    echo '<pre>';
    var_export($result);
} catch (Exception $e) {
    echo $e->getMessage();
}