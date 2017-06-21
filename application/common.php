<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function del_arr_ele_by_key(&$arr,$key){
    if(array_key_exists($key, $arr)){
        $keys= array_keys($arr);
        $index= array_search($key, $keys);
        if($index!==false){
            array_splice($arr,$index,1);
            return $arr;
        }
    }
    return false;
}