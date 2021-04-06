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
    'policyNo' => '662018811432019LKJ00000154',
];

//电子保单参数
//$options = array (
//    'head' =>
//        array (
//            'platform' => 'LKJ',
//            'requestType' => '20',
//            'transactionNo' => \cncn\foundation\util\UUIDGenerator::numberNo(),
//            'timeStamp' => '2019-05-24 18:37:54',
//            'errorCode' => '0000',
//            'errorMsg' => '成功',
//        ),
//    'body' =>
//        array (
//            'policyNos' =>
//                array (
//                    0 =>
//                        array (
//                            'policyNo' => '662018811432019LKJ00000154',
//                        ),
//                ),
//        ),
//);

try {
    $result = \cncn\insurance\InsuranceFactory::YPIC($config)->cancel($options);
    echo '<pre>';
    var_export($result);
} catch (Exception $e) {
    echo $e->getMessage();
}