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
class Conf extends Validate {
    //put your code here
    protected $rule=[
        'ch_name'=> 'require|max:60',
        'en_name'=> 'require|max:60|unique:conf',
        'c_type'=> 'require|number|between:1,3',
        'd_type'=> 'require|number|between:1,6',
        'value'=> 'require',
        'values'=> 'require',
        'id'=> 'require',
        
    ];
    protected $message = [
        'ch_name.require' => '中文名称必须填写',
        'ch_name.max' => '名称最多不能超过60个字符',
        'en_name.require' => '英文名称必须',
        'en_name.max' => '英文名称最多不能超过60个字符',
        'en_name.unique' => '英文名称必须唯一',
        'c_type.number' => '所属栏目必须是数字',
        'c_type.require' => '所属栏目只必填',
        'c_type.between' => '所属栏目只能在1-3之间',
        'd_type.number' => '数据类型必须是数字',
        'd_type.require' => '数据类型只必填',
        'd_type.between' => '数据类型只能在1-6之间',
        'id.required' => 'id不得为空',
        'value.require' => 'id不得为空',
        
    ];
    protected $scene = [
        'add' => ['ch_name', 'en_name','c_type','d_type'],
        'edit' => ['ch_name', 'en_name','c_type','d_type','id','value'],
    ];

}
