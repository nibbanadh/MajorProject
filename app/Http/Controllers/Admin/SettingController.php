<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function SiteSetting(){

        $setting = DB::table('sitesetting')->first();
        return view('admin.setting.site_setting',compact('setting'));
    }

    public function UpdateSiteSetting(Request $request){

        $id = $request->id;

        $data = array();
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['vat'] = $request->vat;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $post_image = $request->file('logo');
        if ($post_image!=NULL){
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,200)->save('public/media/'.$post_image_name);
            $data['logo'] ='public/media/' .$post_image_name;


        }else if($post_image==NULL){
            DB::table('sitesetting')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Data Saved Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);            
        }else{
            $notification=array(
                'message'=>'Failed To Save Data',
                'alert-type'=>'warning'
            );
            return Redirect()->back()->with($notification);  
        }
    }

}


