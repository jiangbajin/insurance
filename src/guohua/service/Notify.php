<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/10/27
 * Time: 15:53
 */
namespace cncn\insurance\guohua\service;

use cncn\insurance\common\BaseInsuranceGateWay;
use cncn\insurance\common\InsuranceException;
use erp\component\insurance\guohua_life\GuohuaLifeService;

/**
 * Class Notify
 * @package cncn\insurance\ypic\service
 */
class Notify extends BaseInsuranceGateWay
{
    public function __construct($logObj = null)
    {
        parent::__construct($logObj);
    }


    /**
     * 回调处理，保联比较粗暴，没有加解密验签等，如果有，该文件统一处理回调
     * @param $raw
     * @param GuohuaLifeService $handler
     * @return bool
     */
    public function process($raw, $handler = null, $isBookNotify = false)
    {
        $this->addLog('==================================================================================================================');
        $this->addLog('url:' . $_SERVER['HTTP_HOST']);
        $this->addLog('回调原始报文' . var_export($raw, true));
        if(empty($raw['ID']) && empty($raw['POLICYNO'])){
            $this->addLog('回调报文不合法，回调报文不包含流水ID或保单号');
        }
        //回调的内容含有中文是unicode字符，必须转成UTF8中文
        $raw = array_map([$this, 'unicodeDecode'], $raw);

        if($isBookNotify){
            $text = '投保格式化报文->';
        }else{
            $text = '撤保格式化报文->';
        }

        $this->addLog($text . json_encode($raw, JSON_UNESCAPED_UNICODE));

        try {
            if ($isBookNotify) {
                //投保业务回调
                if (method_exists($handler, 'bookedCallbackProcess')) {
                    $msg = $handler->bookedCallbackProcess($raw);
                    $this->addLog($msg);
                } else {
                    throw new InsuranceException('bookedCallbackProcess不存在！');
                }
            } else {
                //撤保业务回调
                if (method_exists($handler, 'cancelCallbackProcess')) {
                    $msg = $handler->cancelCallbackProcess($raw);
                    $this->addLog($msg);
                } else {
                    throw new InsuranceException('cancelCallbackProcess不存在！');
                }
            }
        }catch (InsuranceException $e){
            if ($isBookNotify) {
                $this->addLog('投保回调失败，erp相关业务执行失败！！！失败原因：->' . $e->getMessage());
            }else{
                $this->addLog('撤保回调失败，erp相关业务执行失败！！！失败原因：->' . $e->getMessage());
            }

            //业务会错，控制器业务会回滚，就在结束脚本的时刻把通知内容存入到对应的记录中
            register_shutdown_function(function () use ($isBookNotify, $raw, $handler) {
                if ($isBookNotify) {
                    if (method_exists($handler, 'bookedCallbackFailedProcess')) {
                        $handler->bookedCallbackFailedProcess($raw);
                    }
                }else{
                    if (method_exists($handler, 'cancelCallbackFailedProcess')) {
                        $handler->cancelCallbackFailedProcess($raw);
                    }
                }
            });

            throw new InsuranceException($e->getMessage());
        }

        return true;
    }

    /**
     * 回复成功，无需再次通知
     * @param $raw
     */
    public function responseSucced($raw)
    {
        if($raw['ID']){
            $responseStr = <<<XML
<main>
    <wid>{$raw['ID']}</wid>
    <msg>0</msg>
</main>
XML;
        }else{
            $responseStr = <<<XML
<main>
    <pno>{$notifyData['POLICYNO']}</pno>
    <msg>0</msg>
</main>
XML;
        }
        ob_clean();
        echo $responseStr;
    }

    /**
     * 回调业务更新失败回复失败，接受下一次通知
     */
    public function responseFailed()
    {
        ob_clean();
        echo 'failed';
    }
}