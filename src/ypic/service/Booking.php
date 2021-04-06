<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2019/5/24
 * Time: 16:05
 */
namespace cncn\insurance\ypic\service;
use cncn\insurance\common\InsuranceException;
use cncn\insurance\common\YPICInsuranceGateway;

class Booking extends YPICInsuranceGateway
{
    /**
     * 当前接口方法
     * @return string
     */
    protected function getMethod()
    {
        return 'Booking';
    }
    /**
     * 投保接口地址
     * @return string
     */
    protected function getService()
    {
        return 'preCore';
    }

    /**
     * 多线程批量投保
     * @param array $options
     * @return array
     */
    public function multiRequest(array $options = [])
    {
        return parent::multiRequest($options);
    }

    /**
     * 单线程单个投保
     * @param array $options
     * @return null
     */
    public function request(array $options)
    {
        return parent::request($options); // TODO: Change the autogenerated stub
    }

    /**
     * 投保参数校验
     * @param array $options
     * @return array
     */
    protected function checkOptions(array $options = [])
    {
        //判断产品
        if (empty($options['product_id'])) {
            throw new InsuranceException('保险产品id不能为空');
        }

        if (empty($options['insured'])) {
            throw new InsuranceException('被保人为空');
        }

        //判断是否是保险产品库产品
        if (!isset(ProductType::$proList[$options['product_id']])) {
            throw new InsuranceException($options['product_id'] . '不是合法保险产品');
        }

        //从保险库选择产品，获取保险信息
        $product = ProductType::$proList[$options['product_id']];

        //起保日期
        if (empty($options['start_date'])) {
            throw new InsuranceException('起保日期不能为空');
        }
        //起保日期判断
        if (!$this->checkDateTime($options['start_date'])) {
            throw new \RuntimeException('起保日期' . $options['start_date'] . '不是正确的日期格式, 正确格式为19位"2019-01-01 23:59:59"');
        }

        //投保日期
        if (empty($options['insure_date'])) {
            throw new InsuranceException('投保日期不能为空');
        }

        //投保日期判断
        if (!$this->checkDateTime($options['insure_date'])) {
            throw new \RuntimeException('投保日期' . $options['insure_date'] . '不是正确的日期格式, 正确格式为19位"2019-01-01 23:59:59"');
        }

        if (strtotime($options['start_date']) <= strtotime($options['insure_date'])) {
            throw new InsuranceException('起保日期必须大于投保日期');
        }

        //终保日期
        if (empty($options['end_date'])) {
            throw new InsuranceException('投保日期不能为空');
        }
        //终保日期判断
        if (!$this->checkDateTime($options['end_date'])) {
            throw new \RuntimeException('终保日期' . $options['end_date'] . '不是正确的日期格式, 正确格式为19位"2019-01-01 23:59:59"');
        }

        //游客个数
        $insuredNum = count($options['insured']);

        if ($options['amount'] != ($sumAmount = bcmul($product['amount'], $insuredNum, 2))) {
            throw new \RuntimeException("总保额错误! 单份保额{$product['amount']}, 投保份数{$insuredNum}，总保额：{$sumAmount}");
        }
        if ($options['premium'] != ($sumPremium = bcmul($product['price'], $insuredNum, 2))) {
            throw new \RuntimeException("总保费错误! 保费单价{$product['price']}, 投保份数{$insuredNum}，总保额：{$sumPremium}");
        }

        //订单号
        if (empty($options['trade_no'])) {
            throw new InsuranceException('本地保险订单号不能为空');
        }


        //判断线路名称是否为空
        if (empty($options['travelRoute'])) {
            throw new InsuranceException('旅游路线名称不能为空');
        }

        //判断国内游，出境游参数
        if (!in_array($options['DomesticInd'], array_keys(ProductType::$domesticInd))) {
            throw new InsuranceException('是否出境游参数只能为【0:国内游；1：出境游】');
        }

        //判断投保人
        if (empty($options['applicant_name'])) {
            throw new InsuranceException('投保人名称不能为空');
        }

        //投保人类型
        if (!in_array($options['applicant_type'], [1, 2])) {
            throw new InsuranceException('投保人类型参数错误，可选参数【1、个人；2、企业】');
        }

        //投保人类型区分判断
        if ($options['applicant_type'] == 2) {
            if (!in_array($options['applicant_certi_type'], ['1', '2', '3', '4', '99'])) {
                throw new InsuranceException('企业投保人参数不合法，可选参数【1：组织结构代码, 2：税务登记证, 3：营业执照, 4：社会统一信用代码, 99：其他】');
            }

            //企业投保人性别参数置空
            if (!empty($options['applicant_sex'])) {
                throw new InsuranceException('企业投保人性别参数必须为空');
            }

            //判断投保人电话
            if (empty($options['applicant_phone'])) {
                throw new InsuranceException('投保人电话不能空');
            }

            //判断投保人电话是否合法
            if (!$this->isMobileNo($options['applicant_phone'])) {
                throw new InsuranceException('投保人电话不合法');
            }

            //判断投保联系人
            if (empty($options['applicant_contact_name'])) {
                throw new InsuranceException('投保人企业名称不能为空');
            }

            //判断投保企业单位电话
            if (empty($options['applicant_office_phone_number'])) {
                throw new InsuranceException('投保人企业电话不能为空,格式为：0596-6881898');
            }

        } else {
            if (!in_array($options['applicant_certi_type'], ['01', '02', '03', '04', '05', '99'])) {
                throw new InsuranceException('个人投保人参数不合法，可选参数【01：居民身份证, 02：护照, 03：军人证, 04：驾驶证, 05：港澳台通行证，99：其他】');
            }

            //个人投保人性别类型
            if (!in_array($options['applicant_sex'], ['1', '2'])) {
                throw new InsuranceException('个人投保人性别参数不合法，可选参数【1：男, 2：女】');
            }
        }

        //投保人证件号
        if (empty($options['applicant_certi_no'])) {
            throw new InsuranceException('投保人证件号码不能为空');
        }

        //投保人地址
        if (empty($options['applicant_address'])) {
            throw new InsuranceException('投保人地址不能为空');
        }

        //投保人地址
        if (empty($options['applicant_email'])) {
            throw new InsuranceException('投保人邮件不能为空');
        }

        $targets = $insuredList = [];
        //被保人信息判断
        foreach ($options['insured'] as $key => $value) {
            //被保人姓名
            if (empty($value['name'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人名称不能为空');
            }
            //被保人性别
            if (!in_array($value['sex'], [1, 2])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人性别参数不合法，必须满足可选参数【1、男，2、女】');
            }
            //被保人证件类型
            if (!in_array($value['certi_type'], ['01', '02', '03', '04', '05', '99'])) {
                throw new InsuranceException('第' . ($key + 1) . '被保人证件类型不合法，可选参数【01：居民身份证, 02：护照, 03：军人证, 04：驾驶证, 05：港澳台通行证，99：其他】');
            }
            //被保人证件号
            if (empty($value['certi_no'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人证件号码不能为空');
            }
            //被保人人员类型
            if (!in_array($value['type'], [1, 2])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人人员类型错误，可选参数【1、个人；2、企业】');
            }

            //判断被保人电话
            if (empty($value['phone'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人电话不能为空');
            }
            //判断被保人电话是否合法
            if (!$this->isMobileNo($value['phone'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人电话不能不合法');
            }

            //判断被保人电话
            if (empty($value['address'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人地址不能为空');
            }
            //判断被保人电话是否合法
            if (empty($value['email'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人邮箱不能为空');
            }

            //判断被保人年龄
            if (!isset($value['age'])) {
                throw new InsuranceException('第' . ($key + 1) . '个被保人年龄不能为空');
            }else{
                if($value['age'] > 80){
                    throw new InsuranceException('第' . ($key + 1) . '个被保人年龄不能超过80岁');
                }
            }
            //被保人List
            $insuredList[] = [
                'address'    => $value['email'],
                'phone'      => $value['phone'],
                'sex'        => $value['sex'],
                'name'       => $value['name'],
                'certi_type' => $value['certi_type'],
                'type'       => $value['type'],
                'certi_no'   => $value['certi_no'],
                'relation'   => '99', //与投保人关系，定死是其他，ERP系统不登记这个人员关系
                'email'      => $value['email'],
                'age'        => $value['age'],
            ];
        }

        //职业等参数，默认为空，旅游行业不登记职业
        $targets[] = [
            'occupationCode'  => '',
            'occupationType'  => '',
            'occupationLevel' => '',
        ];

        //黄河保险是黄河根据旅控定制的，channel_id是特殊编号，这里都写死，
        //查询的request_no对外部业务无特殊帮助，每次操作唯一，这里定义在SDK内部
        //request_type= 2 是约定的投保类型，本类单一职责，直接写死2
        $data = [
            'channel_id'   => 'LKJ',
            'request_type' => '2',
            'request_no'   => \cncn\foundation\util\UUIDGenerator::numberNo(),
            'biz_content'  =>
                [
                    'end_date'      => $options['end_date'],
                    'amount'        => bcadd($options['amount'], '0', 2),
                    'extend_params' =>
                        [
                            'values'      => '1',
                            'travelRoute' => $options['travelRoute'],
                            'DomesticInd' => $options['DomesticInd'],
                        ],
                    'premium'       => bcadd($options['premium'], '0', 2),
                    'insured'       => $insuredList,
                    'product_id'    => $options['product_id'],
                    'trade_no'      => $options['trade_no'],//订单编号，每次投保唯一，从外部传入，是外部商户的保险订单号
                    'targets'       => $targets,
                    'insure_date'   => $options['insure_date'],
                    'start_date'    => $options['start_date'],
                    'applicant'     =>
                        [
                            'contactName'       => $options['applicant_contact_name'],
                            'address'           => $options['applicant_address'],
                            'phone'             => $options['applicant_phone'],
                            'sex'               => $options['applicant_sex'],
                            'name'              => $options['applicant_name'],
                            'certi_type'        => $options['applicant_certi_type'],
                            'type'              => $options['applicant_type'],
                            'certi_no'          => $options['applicant_certi_no'],
                            'email'             => $options['applicant_email'],
                            'officephonenumber' => $options['applicant_office_phone_number'],
                        ],
                ],
        ];

        return $data;
    }
}