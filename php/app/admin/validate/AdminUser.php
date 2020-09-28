<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/22
 * Time: 21:12
 */

namespace app\admin\validate;

use think\validate;

class AdminUser extends validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        // 'captcha' => 'require|checkCapcha',
    ];

    protected $message = [
        'username' => '用户名必须',
        'password' => '密码必须',
        // 'captcha' => '验证码必须',
    ];

    protected function checkCapcha($value, $rule, $data = [])
    {
        if (!captcha_check($value)) {
            return '验证码不正确';
        }
        return true;
    }
}
