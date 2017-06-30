<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;
use think\Loader;
use think\Controller;
use app\admin\validate\Language as LangV;
use think\Request;
use think\Db;

/**
 * Description of Index
 *
 * @author ZLQ
 */
class Language extends Base{
    public function  index(){
        return $this->fetch();
    }
   
    public function  add(){
        if(request()->isPost()){
            $data =input();
            $data['status']=0;
            if(input('status')=='on'){
                $data['status']=1;
            }            
            $validate = new LangV();
            if ($validate->scene('add')->check($data)) {
                //验证通过则插入
                if (db('language')->insert($data)) {
                    $this->success('插入成功', 'language/add');
                } else {
                    $this->error('插入失败', 'language/lst');
                }
            } else{
                $this->error(dump($validate->getError()),'language/lst');
            };
        }
        return $this->fetch();
    }
    public function edit(){
        $id=input('id');
        $result=db('language')->where('id',$id)->find();
        $this->assign('result',$result);
        if(request()->isPost()){
            $data=input();
             $data['status']=0;
            if(input('status')=='on'){
                $data['status']=1;
            }
            if((db('language')->where('id',input('id'))->update($data))===false){
                $this->error('更新失败', 'language/lst');
            }else{
                 $this->success('更新成功', 'language/lst');
            }
        }
        return $this->fetch();
    }
    public function  lst(){
        $results=db('language')->order('sort asc,id asc')->select();
        $this->assign('results',$results);
        return $this->fetch('list');
    }
    public function  settingLst(){
        $results=db('language')->order('sort asc,id asc')->select();
        if(request()->isPost()){
            $data=input();
            if(array_key_exists('attchment_type', input())){
                $attchment_type= $_POST['attchment_type'];
                $data['attchment_type']= implode(',', $attchment_type);
            }
            
            foreach($data as $key=>$value){
                if(db('language')->where('en_name',$key)->update(['df_value'=>$value])!==false){
                   // 
                }else{
                    $this->error('更新失败', 'language/settinglst');
                }
            }
           $this->success('更新成功', 'language/settinglst');
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        //用来切换语言名称
        \think\Cookie::set('lang','en-us');
        $lang= \think\Cookie::get('lang');
        if($lang=='en-us'){
         //   echo '1111';
        }elseif($lang='zh-cn'){
         //   echo '222';
        }
        //切换结束--en-name不可以有空格
        $this->assign('confs',$results);
        return $this->fetch();
    }
     public  function del(){
        $id=input('id');       
         
        if(db('language')->delete(array('id'=>$id)))
        {
            $this->success(\think\Lang::get('operate_success'), url('language/lst'));
        }else{
            $this->success(\think\Lang::get('operate_failure'), url('language/lst'));
        }    
    } 
     public  function delMuti(){
         $id_arr= input();        
         $rst=TRUE;
         if(array_key_exists('checkbox',$id_arr)){             
             foreach ($id_arr['checkbox'] as $key => $value) {                 
                    if(Db::name('language')->delete($value)){
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
                 if(db('language')->update($value)){
                    $is_success=true;
                 }elseif(db('language')->update($value)===0){
                    $is_success=true;                   
                }else{
                    $is_success=FALSE;
                    $this->error(\think\Lang::get('operate_failure'), 'lst');    
                }
            }
             $this->success(\think\Lang::get('operate_success'), 'lst');    
            
        }
    }
    public function  updateStatus(){
       $data['id']= input('id');          
       if(input('field_name')&&(input('field_value')!==false)){
           $field_name=input('field_name');
            $field_value=input('field_value');
            $data[$field_name]=$field_value;
       }else{
          echo 'error';
       }
        if(db('language')->update($data)!==false){            
                echo 'name'.input('field_name').'value'.input('field_value');
        }else{
            echo 'error';
        }
    }
    public function  getTemplate(){
        $template_path= \think\Config::get('template_path');
       
        $temp= scandir($template_path);
        $templates=array();        
        foreach ($temp as $key => $value) {
            if(is_dir($template_path.$value)&&$value!='.'&&$value!='..'){
                array_push($templates, $value);
            }
        }
        echo implode(',', $templates);        
    }
    
    
    
}
