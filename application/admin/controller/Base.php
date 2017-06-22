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
use think\Lang;
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
        $data_temp= Config::get('data_type');
        $c_temp= Config::get('c_type');
        $data_type=array();
        $c_type=array();
         foreach ($c_temp as $key=>$value){
            $c_type[$key]= Lang::get($value);
        }
        foreach ($data_temp as $key=>$value){
            $data_type[$key]= Lang::get($value);
        }
        $this->assign([
           'cont'=>$cont,
            'data_type'=>$data_type,
            'c_type'=>$c_type,
        ]);
        Log::write('测试日志信息，这是警告级别，并且实时写入','notice');
    }
}
