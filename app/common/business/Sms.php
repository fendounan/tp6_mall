<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 16:41
 */
declare(strict_types=1);

namespace app\common\business;

use app\common\lib\sms\AliSms;
use app\common\lib\Num;
use app\common\lib\ClassArr;

class Sms
{
    public static function sendCode(string $phone, int $len = 6, string $type = 'ali'): bool
    {
        $code = Num::getCode($len);
        // $sms = AliSms::sendCode($phone, $code)
        // 简单工厂模式
        /*$type = ucfirst($type);
        $class = 'app\common\lib\sms\\' . $type . 'Sms';
        $sms = $class::sendCode($phone, $code);*/
        // 封装工厂
        $classArr = ClassArr::smsClassArr();
        $classObj = ClassArr::initClass($type, $classArr);
        $sms = $classObj::sendCode($phone, $code);
        if ($sms) {
            // 入库到redis 设置三分钟失效
            cache(config('redis.code_pre') . $phone, $code, config('redis.code_expire'));
        }
        return $sms;
    }
}
