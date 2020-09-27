<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/27
 * Time: 19:38
 */

namespace app\api\controller;

use app\common\business\User as UserBus;

class User extends AuthBase
{
    public function index()
    {
        $user = (new UserBus())->getNormalUserById($this->userId);
        $resultUser = [
            'id' => $user['id'],
            'username' => $user['username'],
            'sex' => $user['sex'],
        ];
        return show(config('status.success'), 'ok', $resultUser);
    }
}
