<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/18
 * Time: 20:22
 */

namespace app\common\mysql\model;

use think\Model;

class Demo extends Model
{
    public function getStr($val, $data)
    {
        $status = [
            1 => '正常',
            0 => '不正常',
        ];
        return $status[$data['state']];
    }
}
