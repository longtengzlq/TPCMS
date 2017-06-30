<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\validate;
use think\Validate;
/**
 * Description of Conf
 *
 * @author ZLQ
 */
class Language extends Validate {
    //put your code here
     
    protected $rule=[
        'ch_name'=> 'require|max:60',
        'en_name'=> 'require|max:60|unique:conf',
        'id'=> 'require',
        
    ];
    protected $message = [
     
        'ch_name.require' => '中文名称必须填写',
        'ch_name.max' => '名称最多不能超过60个字符',
        'en_name.require' => '英文名称必须',
        'en_name.max' => '英文名称最多不能超过60个字符',
        'en_name.unique' => '英文名称必须唯一',
        'id.required' => 'id不得为空',
      
        
    ];
    protected $scene = [
        'add' => ['ch_name', 'en_name'],
        'edit' => ['ch_name', 'en_name','id'],
    ];


}
