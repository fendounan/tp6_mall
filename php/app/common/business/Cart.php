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
use app\common\lib\Arr;

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
            $get = Cache::hGet(Key::userCart($userId), Key::skuCart($skuId));
            if ($get) {
                $get = json_decode($get, true);
                $redisData['num'] = $get['num'] + $redisData['num'];
            }
            $res = Cache::hSet(Key::userCart($userId), Key::skuCart($skuId), json_encode($redisData, JSON_UNESCAPED_UNICODE));
        } catch (\Exception $e) {
            return false;
        }
        return $res;
    }

    /**
     * Notess:获取购物车列表
     * User: Lint
     * Date: 2020/9/30 13:02
     * @param $userId
     * @return array
     */
    public static function getLists($userId)
    {
        try {
            $get = Cache::hGetAll(Key::userCart($userId));

            $get = array_map(function ($val) {
                return json_decode($val, true);
            }, $get);
            $get = Arr::arraySort($get, 'create_time');

            $result = [];
            foreach ($get as $key => $item) {
                $result[explode(config('redis.cart_sku_pre'), $key)[1]] = $item;
            }

        } catch (\Exception $e) {
            return [];
        }

        // 通过skuid获取价格

        return $result;
    }
}
