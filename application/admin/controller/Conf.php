<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;
use think\Loader;
use think\Controller;
use think\Lang;
use app\admin\validate\Conf as ConfV;
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
        echo Lang::get('text');
        if(request()->isPost()){
            $data =input();
            $data['value']=$data['df_value'];
            $data= del_arr_ele_by_key($data, 'df_value');
           
            $validate = new ConfV();
            if ($validate->scene('add')->check($data)) {
                //验证通过则插入
                if (db('conf')->insert($data)) {
                    $this->success('插入成功', 'conf/add');
                } else {
                    $this->error('插入失败', 'conf/lst');
                }
            } else{
                $this->error(dump($validate->getError()),'Conf/lst');
            };
          
       
        }
        return $this->fetch();
    }
    public function  lst(){
        $results=db('conf')->order('sort asc,id asc')->select();
        $this->assign('results',$results);
        return $this->fetch('list');
    }
     public  function del(){
        $id=input('id');       
         
        if(db('Conf')->delete(array('id'=>$id)))
        {
            $this->success(\think\Lang::get('operate_success'), url('Conf/lst'));
        }else{
            $this->success(\think\Lang::get('operate_failure'), url('Conf/lst'));
        }    
    } 
     public  function delMuti(){
         $id_arr= input();

         $language_id= get_language_id();
         $rst=TRUE;
         if(array_key_exists('checkbox',$id_arr)){             
             foreach ($id_arr['checkbox'] as $key => $value) {                 
                    if(Db::name('article')->delete($value)){
                    } else {
                        $this->error(\think\Lang::get('operate_failure'), 'lst');    
                    };
            }
              $this->success(\think\Lang::get('operate_success'), 'lst');
         }else{
             $this->error(\think\Lang::get('no_selected_checkbox'), 'lst');
         }
    } 
    public  function resort(){
        $sort_arr= input();
      //  dump($sort_arr);
        //$language_id= get_language_id();
        if(array_key_exists('sort',$sort_arr)){
            $datas='';
            foreach ($sort_arr['sort'] as $key => $value) {
                static $k=0;
                $datas[$k]['sort']=$value;
                $datas[$k]['id']=$key;               
                $k++;
            }

            foreach ($datas as $key => $value) {
                 if(db('conf')->update($value)){
                    $is_success=true;
                 }elseif(db('conf')->update($value)===0){
                    $is_success=true;                   
                }else{
                    $is_success=FALSE;
                    $this->error(\think\Lang::get('operate_failure'), 'lst');    
                }
            }
             $this->success(\think\Lang::get('operate_success'), 'lst');    
            
        }
    }
}
