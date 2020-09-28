<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 21:10
 */

namespace app\admin\controller;
use app\BaseController;
use think\exception\HttpResponseException;

class AdminBase extends BaseController
{
    public $adminUser = null;

    public function initialize()
    {
        parent::initialize();
        // 中间件auth做是否登录判断
        // if (empty($this->isLogin())) {
        //     // 基类无法无法跳转 此处返回到BaseController的构造函数中 需要在控制器中return
        //     // return redirect(url('login/index'));
        //     $this->rediret(url('login/index'), 302);
        // }
    }

    public function isLogin()
    {
        $this->adminUser = session(config('admin.session_admin'));
        if (empty($this->adminUser)) {
            return false;
        }
        return true;
    }

    public function rediret(...$args)
    {
        throw new HttpResponseException(redirect(...$args));
    }

}
