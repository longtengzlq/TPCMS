<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\index\controller;
use think\Controller;
use think\Request;

/**
 * Description of Index
 *
 * @author ZLQ
 */
class Index extends Controller{
    public function  index(){
        echo 'controller'.lang_id.'</br>';
       
        return $this->fetch();
    }
}
