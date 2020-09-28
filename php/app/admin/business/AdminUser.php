<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 21:10
 */

namespace app\admin\business;

use app\BaseController;
use think\Exception;
use think\exception\HttpResponseException;
use app\common\model\mysql\AdminUser as AdminUserModel;

class AdminUser
{
    public static function login($data)
    {
        try {
            $adminUserObj = new AdminUserModel();
            $adminUser = self::getAdminUserByUsername($data['username']);
            if (empty($adminUser)) {
                throw new Exception('用户不存在');
            }
            if ($adminUser['password'] != md5($data['password'] . config('param.password_salt'))) {
                throw new Exception('密码不正确');
            }

            // 更新表
            $updateData = [
                'update_time' => date('Y-m-d H:i:s'),
                'last_login_time' => date('Y-m-d H:i:s'),
            ];

            $res = $adminUserObj->updateById($adminUser['id'], $updateData);
            if (empty($res)) {
                throw new Exception('登录失败');
                // return show(config('status.error'), '登录失败');
            }
        } catch (\Exception $e) {
            // todo 记录异常日志 $e->getMessage();
            throw new Exception($e->getMessage());
            // return show(config('status.error'), '异常...登录失败');
        }

        // 记录session
        session(config('admin.session_admin'), $adminUser);
        return true;
    }

    /**
     * Notess:
     * User: Lint
     * Date: 2020/9/22 21:50
     * @param $username
     * @return array|bool|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getAdminUserByUsername($username)
    {
        $adminUserObj = new AdminUserModel();
        $adminUser = $adminUserObj->getAdminUserByUsername($username);

        if (empty($adminUser) || $adminUser->status != config('status.mysql.table_normal')) {
            return false;
        }
        $adminUser = $adminUser->toArray();
        return $adminUser;
    }
}
