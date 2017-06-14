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
class Conf extends Base{
    public function  index(){
        return $this->fetch();
    }
   
    public function  add(){
        if(request()->isPost()){
            if(db('conf')->insert(input())){
                $this->success('插入成功','conf/lst');
            }else{
                $this->error('插入失败', 'conf/lst');
            }
        }
        return $this->fetch();
    }
    public function  lst(){
        $confs=db('conf')->select();
        $this->assign('confs',$confs);
        return $this->fetch('list');
    }
}
