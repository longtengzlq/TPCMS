<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\common\behavior;
use think;
use think\Config;
use think\Request;
use think\View;
use think\Lang;

class LoadLang {

    function run() {

        switch (input('lang')) {
            case 'zh-cn':
                Lang::load(APP_PATH . 'common\lang\zh-cn.php'); 
                think\View::share('lang_name','中文简体');
                break;
            case 'en-us':
                Lang::load(APP_PATH . 'common\lang\en-us.php');
                think\View::share('lang_name','English');
                break;
            default:
                $request = Request::instance();
                switch ($request->module()) {
                    case 'index':
                        Lang::load(APP_PATH . 'common\lang\zh-cn.php');
                        think\View::share('lang_name','中文简体');
                        break;
                    case 'en':
                        Lang::load(APP_PATH . 'common\lang\en-us.php');
                        think\View::share('lang_name','English');
                        break;
                    default:
                        Lang::load(APP_PATH . 'common\lang\zh-cn.php');
                        think\View::share('lang_name','中文简体');
                        break;
                }
                break;
        }
    }
}
