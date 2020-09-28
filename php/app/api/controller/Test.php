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

class Test extends BaseController
{
    public function test()
    {
        // 异常处理 场景1
        // throw new \think\exception\HttpException(401, '找不到相应的数据');

        // 异常处理 场景2
        echo $aaa;
    }
}
