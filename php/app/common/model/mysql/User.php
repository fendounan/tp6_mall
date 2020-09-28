<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/22
 * Time: 10:04
 */

namespace app\common\model\mysql;

use think\Model;

class User extends Model
{


    public function getUserByPhone($phone)
    {
        if (empty($phone)) {
            return false;
        }
        $where = [
            'phone_number' => $phone,
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

    /**
     * Notess:通过id获取用户数据
     * User: Lint
     * Date: 2020/9/27 21:05
     * @param $id
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserById($id)
    {
        $id = intval($id);
        if (!$id) {
            return false;
        }
        return $this->find($id);
    }
}
