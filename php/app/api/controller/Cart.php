<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/29
 * Time: 21:51
 */

namespace app\api\controller;

use app\common\lib\Show;
use think\facade\Cache;
use app\common\business\Cart as CartBus;

class Cart extends ApiBase
{
    public function add()
    {
        if (!$this->request->isPost()) {
            // return Show::error([], '非法请求');
        }

        $id = input('param.id', 0, 'intval');
        $num = input('param.num', 0, 'intval');

        $userId = rand(1, 5);
        $sku_id = rand(1, 5);
        $num = rand(1, 10);

        if (!$userId || !$num) {
            return Show::error([], '参数不合法');
        }

        $res = CartBus::insertRedis($userId, $sku_id, $num);
        if ($res === false) {
            return Show::error([], '添加失败');
        }

        return Show::success([], '添加成功');

    }
}
