<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/22
 * Time: 10:04
 */

namespace app\common\model\mysql;

use think\Model;

class Category extends Model
{


    /**
     * Notess:
     * User: Lint
     * Date: 2020/9/28 16:30
     * @param $field
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalCategorys($field)
    {
        $where = [
            'status' => config('status.mysql.table_normal'),
        ];
        $order = [
            'orders' => 'desc',
            'id' => 'desc',
        ];
        $result = $this->where($where)
            ->field($field)
            ->order($order)
            ->select();
        return $result;
    }

}
