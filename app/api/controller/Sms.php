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

class Sms extends BaseController
{
    public function code()
    {
        // phpinfo();
        $phoneNumber = input('phone_number', '', 'trim');
        // 手机号码验证 validate验证...

        if (empty($phoneNumber)) {
            return show(config('status.error'), '手机号错误');
        }

        $type = '';
        $rand = rand(1, 100);
        if ($rand <= 20) {
            $type = 'baidu';
        } else {
            $type = 'ali';
        }
        // 业务层处理短信
        $result = SmsBus::sendCode($phoneNumber, 6, $type);
        if ($result['result']) {
            return show(config('status.success'), '发送成功'.$result['code']);
        }
        return show(config('status.success'), 'ok');
    }
}
