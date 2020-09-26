<?php
// 应用公共文件
/**
 * Notess:
 * User: BACK-LYJ
 * Date: 2020/9/18 17:20
 * @param $status
 * @param string $msg
 * @param array $data
 * @param int $httpStatus
 * @return \think\response\Json
 */
function show($status, $msg = 'error', $data = [], $httpStatus = 200)
{
    $res = [
        'status' => $status,
        'msg' => $msg,
        'result' => $data,
    ];

    return json($res, $httpStatus);
}
