<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/25
 * Time: 12:01
 */

namespace app\common\lib;
class Str
{
    /**
     * Notess:生成登录token
     * User: Lint
     * Date: 2020/9/27 13:06
     * @param $string
     * @return string
     */
    public static function getLoginToken($string)
    {
        $str = md5(uniqid(md5(microtime(true)), true));
        $token = sha1($str . $string);
        return $token;
    }
}
