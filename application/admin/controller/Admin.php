<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;

/**
 * Description of Index
 *
 * @author ZLQ
 */
class Admin extends Base{
    public function  index(){
        return $this->fetch();
    }
    //put your code here
}
