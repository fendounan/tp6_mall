<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/29
 * Time: 16:48
 */

namespace app\common\lib;

class Show
{
    /**
     * Notess:
     * User: Lint
     * Date: 2020/9/29 16:51
     * @param array $data
     * @param string $msg
     * @param int $status
     * @return mixed
     */
    public static function success($data = [], $msg = 'ok')
    {
        $result = [
            'status' => config('status.success', $status = 1),
            'msg' => $msg,
            'result' => $data,
        ];
        return json($result);
    }

    /**
     * Notess:
     * User: Lint
     * Date: 2020/9/29 16:52
     * @param array $data
     * @param string $msg
     * @param int $status
     * @return mixed
     */
    public static function error($data = [], $msg = 'ok', $status = 0)
    {
        $result = [
            'status' => $status,
            'msg' => $msg,
            'result' => $data,
        ];
        return json($result);
    }
}
