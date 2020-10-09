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


class Demo extends BaseController
{
    /**
     * Notess:互斥锁
     * User: BACK-LYJ
     * Date: 2020/10/10 0:17
     * @param string $key
     * @return int|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function mutexkey($key = 'someKey')
    {
        $key = 'someKey';
        $someValue = Cache::get($key);
        if (empty($someValue)) {
            $mutexkey = "mutex_key_" . $key;
            // 锁住该线程
            if (Cache::store('redis')->set($mutexkey, 'im mutex', 180, 'NX')) {
                $someValue = rand(0, 999);
                Cache::store('redis')->set($key, $someValue);
                Cache::store('redis')->delete($mutexkey);
            } else {
                // 稍后重试
                sleep(50);
                $this->mutexkey($key);
            }
        }
        return $someValue;
    }
}
