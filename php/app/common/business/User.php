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
use app\common\lib\Str;
use app\common\lib\Time;

// use function PHPSTORM_META\type;

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
            throw new \think\Exception('验证码不存在');
        }
        // 判断表是否有该用户
        $user = $this->userObj->getUserByPhone($data['phone_number'])->toArray();
        // print_r($user);
        // 未注册 则注册
        if (!$user) {
            $username = '会员' . $data['phone_number'];
            $userAdd = [
                'username' => $username,
                'phone_number' => $data['phone_number'],
                'type' => $data['type'],
                'status' => config('status.mysql.table_normal'),
                'create_time ' => time(),
                'update_time' => time(),
            ];
            try {

                $userId = $this->userObj->insertGetId($userAdd);
            } catch (\Exception $e) {
                throw new \think\Exception('内部异常' . $e->getMessage());
            }
        } else {
            $userUpdate = [
                'type' => $data['type'],
                'update_time' => time(),
            ];
            try {
                $resUpdate = $this->userObj->where('phone_number', '=', $data['phone_number'])->update($userUpdate);
            } catch (\Exception $e) {
                throw new \think\Exception('内部更新异常' . $e->getMessage());
            }
            $userId = $user['id'];
            $username = $user['username'];
        }
        // return true;

        // 生成token
        $token = Str::getLoginToken($data['phone_number']);
        $redisData = [
            'id' => $userId,
            'username' => $username,
            // 'aa' => 123,
        ];
        $res = cache(config('redis.token_pre') . $token, $redisData, Time::userLoginExpiresTime($data['type']));
        // 返回前端所需要的token
        // new \redis;
        return $res ? ['token' => $token, 'username' => $username] : false;

    }

    /**
     * Notess:返回用户数据
     * User: Lint
     * Date: 2020/9/27 21:07
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalUserById($id)
    {
        $user = $this->userObj->getUserById($id);
        if (!$user || $user->status != config('status.mysql.table_normal')) {
            return [];
        }
        return $user->toArray();
    }
}
