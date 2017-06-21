<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__IMG__'=>STATIC_PATH.'admin/images',
        '__CSS__'=>STATIC_PATH.'admin/css',
        '__JS__'=>STATIC_PATH.'admin/js',
        '__FONTS__'=>STATIC_PATH.'admin/fonts',
    ],
    
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'data_type'=>[
      '1'=>'text',  
      '2'=>'单选型',  
      '3'=>'多选型',  
      '4'=>'文件',  
      '5'=>'下拉菜单',  
      '6'=>'文本域',  
    ],

];
