<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 21:10
 */

namespace app\admin\controller;

use think\facade\View;
use app\BaseController;
use app\common\model\mysql\AdminUser;
use think\facade\Session;

// use app\admin\controller\AdminBase;

class Login extends AdminBase
{
    public function initialize()
    {
        if ($this->isLogin()) {
            return $this->rediret(url('index/index'));
        }
    }


    public function index()
    {
        // 执行顺序为1控制器 2中间件handle 3控制器retur
        // dump('我是login-1');
        // return '我是login-return-2';
        return View::fetch();
    }

    public function test()
    {
        dump(session(config('admin.session_admin')));
        // dump(session('captcha'));

        session('test', 111);
        session('test1', 222);
        dump(session('test'));
    }

    public function check()
    {

        if (!$this->request->isPost()) {
            return show(config('stauts.error'), '请求方式错误');
        }
        $username = $this->request->param('username', '', 'trim');
        $password = $this->request->param('password', '', 'trim');
        // $captcha = $this->request->param('captcha', '', 'trim');

        $validate = new \app\admin\validate\AdminUser();
        $checkData = [
            'username' => $username,
            'password' => $password,
            // 'captcha' => $captcha,
        ];
        // halt($validate->check($checkData));
        if (!$validate->check($checkData)) {
            return show(config('status.error'), $validate->getError());
        }

        try {
            $result = \app\admin\business\AdminUser::login($checkData);
        } catch (\Exception $e) {
            return show(config('status.error'), $e->getMessage());
        }
        // return $result;
        if ($result) {
            return show(config('status.success'), '登录成功');
        } else {

            return show(config('status.error'), '登录失败');
        }
    }
}
