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
class User extends Validate {
    //put your code here
    protected $rule=[
        'cname'=> 'require|max:60',
       
    ];
    protected $message = [
        'cname.require' => '中文名称必须填写',
      
        
    ];
    
}
