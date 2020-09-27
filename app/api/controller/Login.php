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
        $useBus = new User();
        try {
            $result = $useBus->login($data);
        } catch (\Exception $e) {
            return show(config('status.error'), $e->getMessage());
        }

        if ($result) {
            return show(config('status.success'), '登录成功', $result);
        }
        return show(config('status.error'), '登录失败');
    }
}
