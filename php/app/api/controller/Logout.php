<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 16:37
 */

namespace app\api\controller;

use app\BaseController;
use app\common\business\Sms as SmsBus;
use app\api\validate\User as UserValidate;
use app\common\business\User;

class Logout extends AuthBase
{
    public function index()
    {
        // 删除redis缓存
        $res = cache(config('redis.token_pre') . $this->accessToken, NULL);
        if ($res) {
            return show(config('status.success'), '退出成功');
        } else {
            return show(config('status.error'), '退出失败');
        }
    }
}
