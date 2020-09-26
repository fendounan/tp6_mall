<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/26
 * Time: 9:58
 */

namespace app\api\validate;

use  think\validate;

class user extends validate
{
    protected $rule = [
        'username' => 'require',
        'phone_number' => 'require',
        'code' => 'require|number|min:4',
        'type' => 'require|in:1,2',
        // 'type' => ['reuqire', 'in' => '1,2'],
    ];

    protected $message = [
        'username' => '用户名必须',
        'phone_number' => '手机号必须',
        'code.require' => '验证码必须',
        'code.number' => '验证码必须为数字',
        'code.min' => '验证码必须为4位',
        'type.require' => '类型必须',
        'type.in' => '类型值错误',
    ];

    protected $scene = [
        'send_code' => ['phone_number'],
        'login' => ['phone_number', 'code', 'type'],
    ];
}
