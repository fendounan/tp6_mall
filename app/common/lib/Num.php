<?php
/**
 * Num 数字相关的类库方法
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 20:47
 */
declare(strict_types=1);

namespace app\common\lib;
class Num
{
    /**
     * Notess:获取验证码
     * User: Lint
     * Date: 2020/9/24 20:50
     * @param int $len
     * @return int
     */
    public static function getCode(int $len = 4): int
    {
        $code = rand(1000, 9999);
        if ($len == 6) {
            $code = rand(100000, 999999);
        }
        return $code;
    }
}
