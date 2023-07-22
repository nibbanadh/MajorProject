<?php

use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

if(!function_exists('check_access')) {
    function check_access($menu){
        if(!empty($menu)){
            $menu_check= Auth::user()->$menu;
            if($menu_check!="1"){
                return abort(404);             
            }

        }
    }
}

if(!function_exists('setting')) {
    function setting($setting=NULL){
        if(!empty($setting)){
            $setting_name= DB::table('sitesetting')->first();
            if($setting_name->$setting){
                return $setting_name->$setting;        
            }else{
                return "Add Details";
            }

        }else{
            $setting_name= DB::table('sitesetting')->first();
            if($setting_name){
                  return $setting_name;           
            }else{
                return "Add Details";
            }
        }

    }
}

if(!function_exists('seo')) {
    function seo($setting=NULL){
        if(!empty($setting)){
            $setting_name= DB::table('seo')->first();
            if($setting_name->$setting){
                return $setting_name->$setting;        
            }else{
                return "Add Details";
            }

        }else{
            $setting_name= DB::table('sitesetting')->first();
            if($setting_name){
                  return $setting_name;           
            }else{
                return "Add Details";
            }
        }

    }
}