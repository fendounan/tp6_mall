<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/20
 * Time: 11:44
 */

namespace app\demo\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle
{
    public $httpStauts = 500;

    /**
     * Render an exception into an HTTP response.
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // print_r($e);
        // die;
        // dump($e->getStatusCode());
        // die;
        //
        if(method_exists($e,'getStatusCode')){
            $httpStatus = $e->getStatusCode();
        }else {
            $httpStatus = $this->httpStauts;
        }
        return show(config('status.error'), $e->getMessage(), [], $httpStatus);
    }
}
