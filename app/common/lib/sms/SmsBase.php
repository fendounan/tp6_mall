<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/25
 * Time: 19:37
 */
declare(strict_types=1);

namespace app\common\lib\sms;

interface SmsBase
{
    public static function sendCode(string $phone, int $code);
}
