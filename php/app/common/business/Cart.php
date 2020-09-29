<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/19
 * Time: 16:45
 */

namespace app\common\business;

use think\facade\Cache;
use app\common\lib\Key;

class Cart extends BusBase
{
    public static function insertRedis($userId, $skuId, $num)
    {
        //  skuid获取商品数据  不存在则不存redis
        $rand = rand(1, 999);
        $redisData = [
            'title' => '测试商品' . $rand,
            'image' => 'goods_img' . $rand . '.png',
            'num' => $num,
            'goods_id' => $rand,
            'create_time' => date('Y-m-d H:i:s'),
        ];
        try {
            $res = Cache::hSet(Key::userCart($userId), Key::skuCart($skuId), json_encode($redisData, JSON_UNESCAPED_UNICODE));
        } catch (\Exception $e) {
            return false;
        }
        return $res;
    }
}
