<?php
/**
 * Created by PhpStorm.
 * User: 七月
 * Date: 2017/2/12
 * Time: 18:29
 */

namespace app\lib\exception;

class GiftOrderException extends BaseException
{
    public $code = 404;
    public $errorCode = 80010;
    public $msg = "礼品领取失败";
}