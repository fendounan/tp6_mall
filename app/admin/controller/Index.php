<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 21:10
 */

namespace app\admin\controller;

use think\facade\Session;
use think\facade\View;
use app\BaseController;
// use app\admin\controller\AdminBase;
class Index extends AdminBase
{
    public function index()
    {
        // dump(session(config('admin.seesion_admin')));
        return View::fetch();
    }

    public function welcome()
    {
        return View::fetch();
    }

}
