<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 15:52
 */

namespace app\demo\middleware;

class Check
{
    public function handle($request, \Closure $next)
    {
        $request->name = 'jha';
        dump(1);
        return $next($request);
    }

    public function end()
    {
        dump(3);
    }
}
