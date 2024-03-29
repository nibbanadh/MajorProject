<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ContactController extends Controller
{

    public function Contact(){

        return view('pages.contact');
    }

    public function ContactForm(Request $request){

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['message'] = $request->message;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::table('contact')->insert($data);

        $notification=array(
            'message'=>'Your Message Insert Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);     
    }

}
