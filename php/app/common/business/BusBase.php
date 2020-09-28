<?php
/**
 * Created by PhpStorm.
 * User: BACK-LYJ
 * Date: 2020/9/19
 * Time: 16:45
 */

namespace app\common\business;


class BusBase
{
    /**
     * Notess:公共新增逻辑
     * User: Lint
     * Date: 2020/9/28 20:09
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        try {
            $this->model->insertGetid($data);
        } catch (\Exception $e) {
            return false;
        }
        return $this->model->id;
    }
}
