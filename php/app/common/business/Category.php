<?php
/**
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/26
 * Time: 16:24
 */

namespace app\common\business;

use app\BaseController;

use app\common\model\mysql\Category as CategoryModel;
use app\common\lib\Str;
use app\common\lib\Time;

// use function PHPSTORM_META\type;

class Category
{
    public $userObj = null;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }


    public function getNormalCategorys()
    {
        $field = 'id,name,pid';
        $categorys = $this->model->getNormalCategorys($field);
        if (!$categorys) {
            return [];
        }
        $categorys = $categorys->toArray();
        return $categorys;
    }
}
