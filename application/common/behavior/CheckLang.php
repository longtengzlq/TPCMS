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

class CheckLang  {
    //put your code here
    function run(){
            //如果是index.php入口文件或是直接域名进入，则判断跳转
        //使用 $request->baseUrl()=='/index.php'比使用 strpos( $request->baseUrl(),'index.php') !== false 性能提升一些，减少了header以后的判断
        //使用strpos( $request->baseUrl(),'index.php') !== false的好处是可以方便转入调换语言前的界面，模块、操作
        $request= Request::instance();
        if ( $request->baseUrl() == '/'|| $request->baseUrl()=='/index.php'){
            switch ($request->get('lang')) {
                case 'zh-cn':
                    header('location:/index.php/index/');
                    exit;
                    break;
                case 'en-us':
                    header('location:/index.php/en/');
                    exit;
                    break;

                default:
                    header('location:/index.php/index/');
                    break;
            }
        }
    }
}
