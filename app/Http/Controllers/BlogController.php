<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class BlogController extends Controller
{
    public function Blog()
    {
        $title="Blog";
        $post = DB::table('posts')
                ->join('post_category','posts.category_id','post_category.id')
                ->select('posts.*','post_category.category_name_en','post_category.category_name_nep')
                ->get()
        ;

        return view('pages.blog',compact('post','title'));
    }

    public function English()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();
    }

    public function Nepali()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','nepali');
        return redirect()->back();
    }

    public function show($id, $title)
    {
       $post = DB::table('posts')
                ->join('post_category','posts.category_id','post_category.id')
                ->select('posts.*','post_category.category_name_en','post_category.category_name_nep')
                ->where('posts.id',$id)
                ->first()
        ;
        $title= $post->post_title_en; 

        return view('pages.blog_details',compact('post','title'));
    }
}
