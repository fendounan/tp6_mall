<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/25
 * Time: 19:30
 */
declare(strict_types=1);

namespace app\common\lib\sms;

class BaiduSms implements SmsBase
{
    public static function sendCode(string $phone, int $code)
    {
        return true;
    }
}
