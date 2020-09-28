<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/22
 * Time: 10:04
 */

namespace app\common\model\mysql;

use think\Model;

class AdminUser extends Model
{
    /**
     * Notess:用户名获取用户
     * User: Lint
     * Date: 2020/9/22 10:09
     * @param $username
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminUserByUsername($username)
    {
        if (empty($username)) {
            return false;
        }
        $where = [
            'username' => $username,
        ];
        $result = $this->where($where)->find();
        return $result;
    }

    /**
     * Notess:
     * User: Lint
     * Date: 2020/9/22 11:03
     * @param $id
     * @param $data
     * @return AdminUser|bool
     */
    public function updateById($id, $data)
    {
        $id = intval($id);
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }
        $where = [
            'id' => $id,
        ];

        return $this->where($where)->update($data);
    }
}
