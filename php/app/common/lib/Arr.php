<?php
/**
 * 数组相关的类库方法
 * Created by PhpStorm.
 * User: Lint
 * Date: 2020/9/24
 * Time: 20:47
 */

namespace app\common\lib;
class Arr
{

    /**
     * Notess:无限极分类树
     * User: Lint
     * Date: 2020/9/28 16:47
     * @param $data
     * @return array
     */
    public static function getCategoryTree($data)
    {
        $items = [];
        // 组装数据 用id作为数组的键
        $items = array_column($data, null, 'id');
        // print_r($items);
        $tree = [];
        foreach ($items as $id => $item) {
            if (isset($items[$item['pid']])) {
                $items[$item['pid']]['list'][] = &$items[$id];
            } else {
                $tree[] = &$items[$id];
            }
        }
        return $tree;
    }

    /**
     * Notess:截取每层树的个数
     * User: Lint
     * Date: 2020/9/28 18:54
     * @param $data
     * @param int $fisrtCount
     * @param int $secondCount
     * @param int $threeCount
     * @return array
     */
    public static function sliceTreeArr($data, $fisrtCount = 5, $secondCount = 3, $threeCount = 5)
    {
        $data = array_slice($data, 0, $fisrtCount);
        foreach ($data as $k => $v) {
            if (!empty($v['list'])) {
                $data[$k]['list'] = array_slice($v['list'], 0, $secondCount);
                foreach ($v['list'] as $kk => $vv) {
                    if (!empty($vv['list'])) {
                        $data[$k]['list'][$kk]['list'] = array_slice($vv['list'], 0, $threeCount);
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Notess:二维数组根据某个字段排序
     * User: Lint
     * Date: 2020/9/30 12:51
     * @param $array 要排序的数组
     * @param $keys 要排序的键字段
     * @param int $sort 排序类型  SORT_ASC     SORT_DESC
     * @return mixed
     */
    public static function arraySort($array, $keys, $sort = SORT_DESC)
    {
        $keysValue = [];
        foreach ($array as $k => $v) {
            $keysValue[$k] = $v[$keys];
        }
        array_multisort($keysValue, $sort, $array);
        return $array;
    }
}
