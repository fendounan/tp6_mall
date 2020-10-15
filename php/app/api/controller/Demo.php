<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 16:37
 */

namespace app\api\controller;

use app\BaseController;
use app\common\lib\Key;
use think\facade\Cache;
use think\facade;
use app\common\lib\Snowflake;


class Demo extends BaseController
{
    /**
     * Notess:互斥锁 该版本无法处理死锁问题
     * User: Lint
     * Date: 2020/10/10 0:17
     * @param string $key
     * @return int|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function mutexkey($key = 'someKey')
    {
        $key = 'someKey';
        $someValue = Cache::store('redis')->get($key);
        if (empty($someValue)) {
            $mutexkey = "mutex_key_" . $key;
            // 锁住该线程
            if (Cache::store('redis')->set($mutexkey, 'im mutex', 180, 'NX')) {
                $someValue = rand(0, 999);
                Cache::store('redis')->set($key, $someValue);
                Cache::store('redis')->delete($mutexkey);
            } else {
                // 稍后重试
                sleep(2);
                $this->mutexkey($key);
            }
        }
        return $someValue;
    }

    /**
     * Notes:解决互斥锁死锁问题
     * User: Lint
     * Date: 2020/10/13 21:28
     * @param string $key
     * @return int|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function mutexkeyNoDead($key = 'name')
    {
        $myName = Cache::store('redis')->get($key);
        // 过期时间
        $expire = 10;
        if (!$myName) {
            $mutexkey = "mutex_key_" . $key;
            $mutexVal = time() + $expire;
            // 加锁 并且加上过期时间
            $lock = Cache::store('redis')->set($mutexkey, $mutexVal, $expire, 'NX');
            // 成功加锁
            // 或者获取到上次的锁值时间小于当前时间 && 成功的更新了锁值(getSet需要key值存在才能执行 有key说明之前的线程有加锁但是未删除) && 上次的锁值小于当前时间
            // 则进入逻辑处理 并且删除锁
            if ($lock || (Cache::store('redis')->get($mutexkey) < time() && Cache::store('redis')->getSet($mutexkey, $mutexVal) < time())) {
                //******************************
                //此处执行插入、更新缓存操作...
                //******************************
                $myName = rand(0, 999);
                Cache::store('redis')->set($key, $myName);
                Cache::store('redis')->delete($mutexkey);
            } else {
                // 稍后重试
                sleep(2);
                $this->mutexkey($key);
            }
        }
        return $myName;
    }

    /**
     * Notes:秒杀
     * User: Lint
     * Date: 2020/10/15 22:52
     * @throws \Exception
     */
    public function secKill()
    {
        $workId = rand(1, 1023);
        $userId = Snowflake::getInstance()->setWorkId($workId)->nextId();

        $listKey = "goods_list";
        $orderKey = "buy_order";
        $failUserNum = "fail_user_num";
        $allUserNum = "all_user_num";
        // 统计总人数
        Cache::store('redis')->incr($allUserNum);
        if ($goodsId = Cache::store('redis')->lPop($listKey)) {
            // 秒杀成功
            // 将幸运用户存在集合中
            Cache::store('redis')->hSet($orderKey, $goodsId, $userId);
        } else {
            //秒杀失败
            //将失败用户计数
            Cache::store('redis')->incr($failUserNum);
        }
        echo "SUCCESS";
    }

    /**
     * Notes:添加秒杀商品
     * User: Lint
     * Date: 2020/10/15 22:53
     */
    public function addGoods()
    {
        $count = 10;
        $listKey = "goods_list";
        for ($i = 1; $i <= $count; $i++) {
            //将商品id push到列表中
            Cache::store('redis')->rPush($listKey, $i);
        }
    }
}
