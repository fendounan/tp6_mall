<?php
/**
 * 要使该自定义异常类生效 需要在本模块下的provider.php中绑定自定义异常类
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 11:44
 */

namespace app\api\exception;

use think\exception\Handle;
use think\Response;
use Throwable;


class Http extends Handle
{
    public $httpStauts = 500;

    /**
     * 返回api格式的异常 仅作用于当前api模块
     * Render an exception into an HTTP response.
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof \think\Exception) {
            return show($e->getCode(), $e->getMessage());
        }

        // 处理api基类中的show方法
        if ($e instanceof \think\exception\HttpResponseException) {
            // return show($e->getCode(), $e->getMessage());
            return parent::render($request, $e);
        }

        // 此处为了能够正常获取到控制器中throw new \think\exception\HttpException(401, 'xx');的statusCode
        // 并且处理了 没有手动处理未知异常时捕获不到getStatusCode()方法
        if (method_exists($e, 'getStatusCode')) {
            $httpStatus = $e->getStatusCode();
        } else {
            $httpStatus = $this->httpStauts;
        }
        return show(config('status.error'), $e->getMessage(), [], $httpStatus);
    }
}
