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

class Login extends BaseController
{
    public function index()
    {
        $phone = input('phone_number', '', 'trim');
        $code = input('param.code', 0, "intval");
        $type = input('param.type', 0, "intval");
        $data = [
            'phone_number' => $phone,
            'code' => $code,
            'type' => $type,
        ];
        $validate = new UserValidate();
        // halt($validate);
        if (!$validate->scene('login')->check($data)) {
            return show(config('status.error'), $validate->getError());
        }
        $result = (new \app\common\business\User())->login($data);
        return show(config('status.error'), '登录失败');
    }
}
