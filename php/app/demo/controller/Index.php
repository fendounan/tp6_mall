<?php

namespace app\demo\controller;
use think\facade\Session;
use app\BaseController;
use app\common\business\Member;

class Index extends BaseController
{
    public function index()
    {
    }

    public function hello()
    {
        $res = rand(50000, 90000);
        echo $res;
        halt();
    }

    public function abc()
    {
        $result = [
            'status' => 1,
            'msg' => 'ok',
            'data' => [
                'id' => 1,
            ]
        ];
        $header = [
            'token' => md5(1),
        ];
        $options = [
            'time' => 132,
        ];
        return json($result, 200, $header, $options);
    }

    public function test()
    {
        phpinfo();
        // halt(session(config('admin.session_admin')));
        // session('ddd','1123123');
        // dump(session('ddd'));
        // dump(session('captcha'));
        //
        // echo md5('admin'.config('param.password_salt'));
        // echo session('captcha');





        // echo $a;
        // throw new \think\exception\HttpException(400, '没有数据');
        // $id = input('id');
        // if (empty($id)) {
        //     return show(0, 'id is null');
        // }
        // $obj = new Member();
        // $list = $obj->getMemberByMemberId($id, 10);
        // halt($list);
        // // $res = Member::where('MemberId','>',10)->find();
        // // dump($res->toArray());
        //
        // $obj = new Member();
        // $res2 = $obj->where('MemberId', '<', 11799)->select();
        // // dump($res2);
        // foreach ($res2 as $value) {
        //     // dump($value['State']);
        //     dump($value->State_text);
        // }
    }

    public function a()
    {
    }
}
