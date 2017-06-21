<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;
use think\Request;
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
        $this->assign('cont',$cont);
        Log::write('测试日志信息，这是警告级别，并且实时写入','notice');
    }
}
