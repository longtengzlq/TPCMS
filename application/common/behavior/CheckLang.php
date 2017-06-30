<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CheckLang
 *
 * @author ZLQ,系统启动前检测语言环境
 */
namespace app\common\behavior;
use think\Request;
use think\Debug;
use think\Cookie;
use think\Lang;
use think\Db;

class CheckLang  {
    //put your code here
    function run(){
            //如果是index.php入口文件或是直接域名进入，则判断跳转
        //使用 $request->baseUrl()=='/index.php'比使用 strpos( $request->baseUrl(),'index.php') !== false 性能提升一些，减少了header以后的判断
        //使用strpos( $request->baseUrl(),'index.php') !== false的好处是可以方便转入调换语言前的界面，模块、操作
        $request= Request::instance();
        //判断是否入后文件，如果是则执行跳转，否则加载语言
        if ( $request->baseUrl() == '/'|| $request->baseUrl()=='/index.php'){
            echo 'base';
            //直接通过入口文件加语言参数访问
            if($request->get('lang_id')!=null){              
                //判断传入的语言变量是否属于数据库定义的语言，如果否则默认定义为数据库语言的第一种语言，
               $language=db('language')->field('id,data_name,en_name,lname,lang_file')->where('id',$request->get('lang_id'))->find();
               if($language){
                   if(!defined('lang_id')){
                        define('lang_id',$request->get('lang_id'));
                    }
                    Lang::load(APP_PATH . 'common\lang\\'.$language['lang_file']);
               }else{
                   //因为语言表中不存在该表故不需要再去读取配置文件
                   $langs=db('language')->order('sort asc,id asc')->limit(1)->select();
                   $lang_id=$langs[0]['id']; 
                   if(!defined('lang_id')){
                        define('lang_id',$lang_id);
                    }
                    Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);
               }              
            }else{
                //此处应先找数据库中的关于系统语言的默认配置，如果没有则找配置文件中的默认配置，否则为简体中文
                $lang_setting=db('conf')->where('en_name','languange_id')->find();
                if($lang_setting){
                    $lang=db('language')->where('id',$lang_id)->find();
                    if($lang){
                        $lang_id=$lang_setting['value'];
                        if(!defined('lang_id')){
                            define('lang_id',$lang_id);
                        }
                        Lang::load(APP_PATH . 'common\lang\\'.$lang['lang_file']);
                    }else{
                        //配置文件中未定义默认语言，则定义为系统语言的排序第一的语言
                        $langs=db('language')->order('sort asc,id asc')->limit(1)->select();
                        $lang_id=$langs[0]['id']; 
                        if(!defined('lang_id')){
                            define('lang_id',$lang_id);
                        }
                        Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);                        
                    }                    
                }else{
                    //获取配置文件中定义的默认语言，如果找到再判断是否属于数据库中定义语言的一种，如果否则更改为数据库的第一种语言
                    $lang_config_name= \think\Config::get('default_lang');
                    $langs=db('language')->order('sort asc,id asc')->select();
                    if($lang_config_name){
                        $find=false;
                        foreach ($langs as $key => $value) {
                            //配置文件中默认语言的定义可以是语言ID，语言data_name，也可以是语言文件名称（可带可不带后缀）
                            if($value['data_name']==$lang_config_name||$value['id']==$lang_config_name||$lang_config_name==$value['lang_file']||$lang_config_name==substr($value['lang_file'],0, strpos($value['lang_file'],'.'))){
                                echo '配置文件中的默认语言在数据库中找到了';
                                $lang_id=$value['id'];
                                $lang_file=$value['lang_file'];
                                $find=true;
                                break;
                            }
                        }
                        if($find){
                            if(!defined('lang_id')){
                                define('lang_id',$lang_id);
                            }
                            Lang::load(APP_PATH . 'common\lang\\'.$lang_file);            
                        }else{
                            echo '配置文件中个关于默认语言的定义找不到,自定义为数据库第一种语言';
                            $lang_id=$langs[0]['id'];    
                            Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);    
                        }
                    }else{  //配置文件中未定义默认语言，则定义为系统语言的排序第一的语言
                        echo '只好自己定义了';
                         $lang_id=$langs[0]['id'];
                         Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);
                    }
                }
                
                
            }
           
//             if($request->get('lang')=='zh-cn'){
//            header('location:/index.php/index/');
//            } elseif($request->get('lang')=='en-us') {
//                header('location:/index.php/en/');
//            }else{
//                header('location:/index.php/index/');
//            }
        }else{
            if($request->get('lang_id')!=null){              
                //判断传入的语言变量是否属于数据库定义的语言，如果否则默认定义为数据库语言的第一种语言，
               $language=db('language')->field('id,data_name,en_name,lname,lang_file')->where('id',$request->get('lang_id'))->find();
               if($language){
                   if(!defined('lang_id')){
                        define('lang_id',$request->get('lang_id'));
                    }
                    Lang::load(APP_PATH . 'common\lang\\'.$language['lang_file']);
               }else{
                   //因为语言表中不存在该表故不需要再去读取配置文件
                   $langs=db('language')->order('sort asc,id asc')->limit(1)->select();
                   $lang_id=$langs[0]['id']; 
                   if(!defined('lang_id')){
                        define('lang_id',$lang_id);
                    }
                    Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);
               }              
            }else{
                //此处应先找数据库中的关于系统语言的默认配置，如果没有则找配置文件中的默认配置，否则为简体中文
                $lang_setting=db('conf')->where('en_name','languange_id')->find();
                if($lang_setting){
                    $lang=db('language')->where('id',$lang_id)->find();
                    if($lang){
                        $lang_id=$lang_setting['value'];
                        if(!defined('lang_id')){
                            define('lang_id',$lang_id);
                        }
                        Lang::load(APP_PATH . 'common\lang\\'.$lang['lang_file']);
                    }else{
                        //配置文件中未定义默认语言，则定义为系统语言的排序第一的语言
                        $langs=db('language')->order('sort asc,id asc')->limit(1)->select();
                        $lang_id=$langs[0]['id']; 
                        if(!defined('lang_id')){
                            define('lang_id',$lang_id);
                        }
                        Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);                        
                    }                    
                }else{
                    //获取配置文件中定义的默认语言，如果找到再判断是否属于数据库中定义语言的一种，如果否则更改为数据库的第一种语言
                    $lang_config_name= \think\Config::get('default_lang');
                    $langs=db('language')->order('sort asc,id asc')->select();
                    if($lang_config_name){
                        $find=false;
                        foreach ($langs as $key => $value) {
                            //配置文件中默认语言的定义可以是语言ID，语言data_name，也可以是语言文件名称（可带可不带后缀）
                            if($value['data_name']==$lang_config_name||$value['id']==$lang_config_name||$lang_config_name==$value['lang_file']||$lang_config_name==substr($value['lang_file'],0, strpos($value['lang_file'],'.'))){
                                echo '配置文件中的默认语言在数据库中找到了';
                                $find=true;
                                break;
                            }
                        }
                        if($find){
                            if(!defined('lang_id')){
                                define('lang_id',$lang_id);
                            }
                            Lang::load(APP_PATH . 'common\lang\\'.$lang_file);    
                        }else{
                            echo '配置文件中个关于默认语言的定义找不到,自定义为数据库第一种语言';
                            $lang_id=$langs[0]['id'];
                            Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);
                        }
                    }else{  //配置文件中未定义默认语言，则定义为系统语言的排序第一的语言
                        echo '只好自己定义了';
                         $lang_id=$langs[0]['id'];
                         Lang::load(APP_PATH . 'common\lang\\'.$langs[0]['lang_file']);
                    }
                }
                
                
            }
        }
        
    }
}
