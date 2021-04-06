<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/10/27
 * Time: 14:45
 */
namespace cncn\insurance\common;

abstract class BaseInsuranceGateWay
{
    /**
     * 是否开启日志
     */
    protected $log = true;
    protected $logObj = null;
    protected $logAction = 'info';

    public function __construct($logObj = null)
    {
        if ($logObj){
            $this->logObj = $logObj;
        }
    }

    /**
     * 加密
     * @param $data
     * @return string
     */
    protected function encrypt($data)
    {
        //todo
    }

    /**
     * 解密
     * @param $data
     * @return mixed
     */
    protected function decrypt($data)
    {
        //todo
    }

    /**
     * 判断日期字符串是否合法
     * 票付通规定日期必须是10位用两个"-"隔开的字符串
     * @param string $dateTimeStr
     * @return string
     */
    protected function checkDateTime($dateTimeStr = '2019-01-01 23:59:59')
    {
        if(strlen($dateTimeStr) != 19  || strtotime($dateTimeStr) === false){
            return false;
        }else{
            return true;
        }
    }


    /**
     * 判断日期字符串是否合法
     * 票付通规定日期必须是10位用两个"-"隔开的字符串
     * @param string $dateTimeStr
     * @return string
     */
    protected function checkDate($dateTimeStr = '2019-01-01')
    {
        return preg_match('/^[\d]{4}\-[\d]{1,2}-[\d]{1,2}$/', $date);
    }

    /**
     * 截止至201807已公布最新号段
     * 移动号段：134 135 136 137 138 139 147(上网卡) 148 150 151 152 157 158 159 172 178 182 183 184 187 188 198
     * 联通号段：130 131 132 145(上网卡) 146(4G) 155 156 166 171 175 176 185 186
     * 电信号段：133 149 153 173 174 177(4G) 180 181 189 199
     * 卫星通信：1349
     * 虚拟运营商：170
     * 验证是否是手机号
     * @param $mobile
     * @return bool
     */
    public function isMobileNo($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,6,7,8,9]{1}\d{8}$|^15[^4]{1}\d{8}$|^16[6]{1}\d{8}$|^17[^9]{1}\d{8}$|^18[\d]{9}$|^19[8,9]{1}\d{8}$#', $mobile) ? true : false;

    }

    /**
     * 公用日志
     * @param $msg
     */
    public function addLog($msg){
        if ($this->logObj){
            $logAction = $this->logAction;
            $this->logObj->$logAction($msg);
        }
    }


    /**
     * unicode转中文
     * @param $unicodeStr
     * @return string
     */
    public function unicodeDecode($unicodeStr){
        $json = '{"str":"'.$unicodeStr.'"}';
        $arr = json_decode($json,true);
        if(empty($arr)) return '';
        return $arr['str'];
    }

    /**
     * 中文转unicode
     * @param $str
     * @return string
     */
    public function unicodeEncode($str){
        //split word
        preg_match_all('/./u',$str,$matches);

        $unicodeStr = "";
        foreach($matches[0] as $m){
            //拼接
            $unicodeStr .= "&#".base_convert(bin2hex(iconv('UTF-8',"UCS-4",$m)),16,10);
        }
        return $unicodeStr;
    }
}