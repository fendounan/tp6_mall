<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/27
 * Time: 16:55
 */

namespace app\common\lib;
class Time
{

    /**
     * Notess:登录token有效期
     * User: Lint
     * Date: 2020/9/27 16:57
     * @param int $type
     * @return float|int
     */
    public static function userLoginExpiresTime($type = 2)
    {
        $type = !in_array($type, [1, 2]) ? 2 : $type;
        if ($type == 1) {
            $day = 7;
        } else {
            $day = 30;
        }
        return $day * 24 * 3600;
    }
}
