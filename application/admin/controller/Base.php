<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;
use think\Request;
use think\Config;
use think\Log;
/**
 * Description of Base
 *
 * @author ZLQ
 */
class Base extends \think\Controller {
    //put your code here
    function _initialize() {
       
        parent::_initialize();
        $request= Request::instance();
        $cont= $request->controller();
        $data_type= Config::get('data_type');
        $this->assign([
           'cont'=>$cont,
            'data_type'=>$data_type,
        ]);
        Log::write('测试日志信息，这是警告级别，并且实时写入','notice');
    }
}
