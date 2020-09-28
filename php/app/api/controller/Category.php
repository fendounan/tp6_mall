<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 16:37
 */

namespace app\api\controller;

use app\BaseController;
use app\common\business\Category as CategoryBus;
use app\common\lib\Arr;

class Category extends ApiBase
{
    public function index()
    {
        try {
            $categoryBus = new CategoryBus();
            $categorys = $categoryBus->getNormalCategorys();
        } catch (\Exception $e) {
            return show(config('status.error'), $e->getMessage());
        }
        if (empty($categorys)) {
            return show(config('status.error'), 'ok', []);
        }
        $result = Arr::getCategoryTree($categorys);
        $result = Arr::sliceTreeArr($result, 5, 3, 2);
        return show(config('status.success'), 'ok', $result);
        // print_r($result);/
    }
}
