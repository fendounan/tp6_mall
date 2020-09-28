<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/25
 * Time: 20:13
 */

namespace app\common\lib;
class ClassArr
{
    /**
     * Notess:工厂模式短信类
     * User: Lint
     * Date: 2020/9/25 20:30
     * @return array
     */
    public static function smsClassArr()
    {
        return [
            'ali' => 'app\common\lib\sms\AliSms',
            'baidu' => 'app\common\lib\sms\BaiduSms',
            'jd' => 'app\common\lib\sms\JdSms',
        ];
    }

    /**
     * Notess:工厂模式上传类
     * User: Lint
     * Date: 2020/9/25 20:30
     * @return array
     */
    public static function uploadClassArr()
    {
        return [
            'txt' => 'xxx',
            'image' => 'xxx',
        ];
    }

    /**
     * Notess:初始化对应工厂
     * User: Lint
     * Date: 2020/9/25 20:31
     * @param $key 数组arr的key
     * @param $classArr 整个数组
     * @param array $params 实例化对象的参数
     * @param bool $needInstance 是否需要实例化
     * @return bool|mixed|object
     * @throws \ReflectionException
     */
    public static function initClass($key, $classArr, $params = [], $needInstance = false)
    {
        // key表示数组arr的key classArr代表整个数组
        // 如果工厂模式调用的是静态方法 则直接返回类
        // 如果非静态的
        // 是否存在该类
        if (!array_key_exists($key, $classArr)) {
            return false;
        }
        $className = $classArr[$key];

        if ($needInstance) {
            // 需要实例化 借用反射机制实例化一个类
            // new \ReflectionClass($className) 建立反射类
            // newInstanceArgs($params) 相当于实例化类
            return (new \ReflectionClass($className))->newInstanceArgs($params);
        } else {
            // 不需要实例化 静态方法直接调用
            return $className;
        }
    }
}
