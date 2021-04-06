<?php
/**
 * Created by PhpStorm.
 * User: 江艺勤
 * Date: 2020/10/27
 * Time: 14:10
 */
namespace cncn\insurance\common;

class InvalidInstanceException extends \Exception
{
    /**
     * @var array
     */
    public $raw = [];

    /**
     * InvalidResponseException constructor.
     * @param string $message
     * @param integer $code
     * @param array $raw
     */
    public function __construct($message, $code = 0, $raw = [])
    {
        parent::__construct($message, intval($code));
        $this->raw = $raw;
    }
}