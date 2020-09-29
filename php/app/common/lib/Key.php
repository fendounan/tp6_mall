<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/29
 * Time: 23:04
 */

namespace app\common\lib;
class Key
{
    /**
     * Notess:记录用户购物车redis的key
     * User: Lint
     * Date: 2020/9/29 23:06
     * @param $userId
     * @return string
     */
    public static function userCart($userId)
    {
        return config('redis.cart_pre') . $userId;
    }

    /**
     * Notess:用户购物车redis hash的key
     * User: Lint
     * Date: 2020/9/29 23:08
     * @param $skuId
     * @return string
     */
    public static function skuCart($skuId)
    {
        return config('redis.cart_sku_pre') . $skuId;
    }
}
