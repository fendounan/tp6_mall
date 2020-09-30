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
use app\common\lib\Snowflake;

class Test extends BaseController
{
    public function test()
    {
        // 异常处理 场景1
        // throw new \think\exception\HttpException(401, '找不到相应的数据');

        // 异常处理 场景2
        // echo $aaa;

        // 雪花算法生成唯一id workid 机器id最大1023 源码中定义
        $workId = rand(1,1023);
        $id = Snowflake::getInstance()->setWorkId($workId)->nextId();
        echo $id;
    }
}
