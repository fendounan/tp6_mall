<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/26
 * Time: 16:24
 */

namespace app\common\business;

use app\BaseController;
use app\common\model\mysql\User as UserModel;

class User
{
    public $userObj = null;

    public function __construct()
    {
        $this->userObj = new UserModel();
    }

    public function login($data)
    {
        $redisCode = cache(config('redis.code_pre') . $data['phone_number']);
        // halt($redisCode);
        if (empty($redisCode) || $redisCode != $data['code']) {
            // throw new \think\Exception('验证码不存在');
        }
        // 判断表是否有该用户
        $user = $this->userObj->getUserByPhone($data['phone_number']);
        // 未注册 则注册
        if (!$user) {
            $username = '会员' . $data['phone_number'];
            $userAdd = [
                'username' => $username,
                'phone_number' => $data['phone_number'],
                'type' => $data['type'],
                'status' => config('status.mysql.table_normal'),
            ];
            try {

                $userId = $this->userObj->insertGetId($userAdd);
            } catch (\Exception $e) {
                throw new \think\Exception('内部异常'.$e->getMessage());
            }
        }

        // 生成token
    }
}
