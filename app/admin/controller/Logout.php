<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 21:10
 */

namespace app\admin\controller;
use app\BaseController;

// use think\facade\Session;

class Logout extends AdminBase
{


    public function index()
    {
        session(config('admin.session_admin'), null);
        return $this->rediret(url('login/index'));
    }


}
