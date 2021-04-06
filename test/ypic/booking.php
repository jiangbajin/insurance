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


//适用业务的电子保单参数
$options = [
    'product_id'                    => '11430010004',
    'start_date'                    => '2019-09-28 00:00:00',
    'insure_date'                   => date('Y-m-d H:i:s', strtotime('+ 2 days')),
    'end_date'                      => '2019-10-29 23:59:59',
    'amount'                        => '800000.00',
    'premium'                       => '100.00',
    'trade_no'                      => \cncn\foundation\util\UUIDGenerator::numberNo(),
    'travelRoute'                   => '国内',
    'DomesticInd'                   => '0',
    'applicant_name'                => '张朝杰',
    'applicant_type'                => '1',
    'applicant_certi_type'          => '99',
    'applicant_sex'                 => '1',
    'applicant_phone'               => '13161084234',
    'applicant_contact_name'        => '张朝杰',
    'applicant_office_phone_number' => '0596-6881895',
    'applicant_certi_no'            => '410922198502159418',
    'applicant_address'             => '河南小区',
    'applicant_email'               => '773553241@qq.com',
    'insured'                       => [
        0 => [
            'name'       => '娄沐阳',
            'sex'        => '1',
            'certi_type' => '01',
            'certi_no'   => '230321199303263177',
            'type'       => '1',
            'phone'      => '13666036274',
            'address'    => '河南小区',
            'email'      => '773553241@qq.com',
            'relation'   => '99',
            'age'        => '30'
        ],
        1 => [
            'name'       => '任悦',
            'sex'        => '1',
            'certi_type' => '01',
            'certi_no'   => '350801199005015393',
            'type'       => '1',
            'phone'      => '13666036274',
            'address'    => '河南小区',
            'email'      => '773553241@qq.com',
            'relation'   => '99',
            'age'        => '30'
        ]
    ]
];

//黄河保险文档里面原始的保单参数
//$options = array (
//    'channel_id' => 'LKJ',
//    'request_type' => '2',
//    'request_no' => \cncn\foundation\util\UUIDGenerator::numberNo(),
//    'biz_content' =>
//        array (
//            'end_date' => '2019-10-29 23:59:59',
//            'amount' => '800000.00',
//            'extend_params' =>
//                array (
//                    'values' => '1',
//                    'travelRoute' => '国内',
//                    'DomesticInd' => '0',
//                ),
//            'premium' => '100.00',
//            'insured' =>
//                array (
//                    0 =>
//                        array (
//                            'address' => '河南小区',
//                            'phone' => '13666036274',
//                            'sex' => '1',
//                            'name' => '程嘉昌',
//                            'certi_type' => '01',
//                            'type' => '1',
//                            'certi_no' => '410922198502159418',
//                            'relation' => '0',
//                            'email' => '773553241@qq.com',
//                        ),
//                ),
//            'product_id' => '11430010004',
//            'trade_no' => \cncn\foundation\util\UUIDGenerator::numberNo(),
//            'targets' =>
//                array (
//                    0 =>
//                        array (
//                            'occupationCode' => '',
//                            'occupationType' => '',
//                            'occupationLevel' => '',
//                        ),
//                ),
//            'insure_date' => date('Y-m-d H:i:s', strtotime('+ 2 days')),
//            'start_date' => '2019-09-28 00:00:00',
//            'applicant' =>
//                array (
//                    'contactName' => '程嘉昌',
//                    'address' => '河南小区',
//                    'phone' => '13161084234',
//                    'sex' => '1',
//                    'name' => '张朝杰',
//                    'certi_type' => '01',
//                    'type' => '1',
//                    'certi_no' => '410922198502159418',
//                    'email' => '773553241@qq.com',
//                    'officephonenumber' => '0596-6881895',
//                ),
//        ),
//);


try {
    $result = \cncn\insurance\InsuranceFactory::YPIC($config)->booking($options);
    echo '<pre>';
    var_export($result);
} catch (Exception $e) {
    echo $e->getMessage();
}