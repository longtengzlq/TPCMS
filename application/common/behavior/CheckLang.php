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
use think\Cookie;

class CheckLang  {
    //put your code here
    function run(){

        $request = Request::instance();
        //echo $request->url();
       // header('location:' . $request->baseUrl());
        //如果是index.php入口文件或是直接域名进入，则判断跳转
        if (strpos( $request->baseUrl(),'index.php') !== false || $request->baseUrl() == '/') {
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
