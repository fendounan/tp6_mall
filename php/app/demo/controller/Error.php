<?php

namespace app\controller;

use app\BaseController;

class Error
{
    public function __call($name,$arg)
    {
        $arr = [
            'status' => 0,
            'msg' => '找不到该控制器',
        ];
        return json($arr);
    }
}
