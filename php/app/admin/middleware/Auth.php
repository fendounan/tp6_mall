<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 15:52
 */
declare(strict_types=1);

namespace app\admin\middleware;

class Auth
{
    public function handle($request, \Closure $next)
    {
        // 执行顺序为1控制器 2中间件handle 3控制器return
        // 前置中间件 前置中间件获取不到控制器和方法
        if (empty(session(config('admin.session_admin'))) && !preg_match('/login/', $request->pathinfo())) {
            return redirect((string)url('login/index'));
        }

        // 后置
        $response = $next($request);

        // 此处后置中间件不能做未登录跳转 需在前置中间件中处理 否则会执行controller中的逻辑
        // if (empty(session(config('admin.session_admin'))) && $request->controller() != 'Login') {
        //     return redirect((string)url('login/index'));
        // }
        // echo '我是后置中间件-3';
        return $response;
    }

    public function end(\think\Response $response)
    {
        // dump(3);
    }
}
