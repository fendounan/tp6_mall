<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/19
 * Time: 16:45
 */

namespace app\common\business;

use app\common\model\mysql\Member as MemberModel;

class Member
{
    public static function getMemberByMemberId($id, $limit = 10)
    {
        if (empty($id)) {
            return [];
        }
        $memberModel = new MemberModel();
        $results = $memberModel->getMemberByMemberId($id, $limit);
        foreach ($results as &$result) {
            $result['StateStr'] = $result['State'] == 1 ? '正常' : '不正常';
        }
        unset($result);
        return $results;
    }
}
