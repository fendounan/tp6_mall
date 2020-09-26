<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/18
 * Time: 20:43
 */

namespace app\common\model\mysql;

use think\Model;

class Member extends Model
{
    protected $pk = 'MemberId';

    public function getStateTextAttr($val, $data)
    {
        $status = [
            1 => '正常',
            0 => '不正常',
        ];
        return $status[$data['State']];
    }

    public function getMemberByMemberId($id, $limit = 10)
    {
        if (empty($id)) {
            return [];
        }
        $result = $this->where('MemberId', '=', $id)
            ->limit($limit)
            ->select()
            ->toArray();
        return $result;
    }
}
