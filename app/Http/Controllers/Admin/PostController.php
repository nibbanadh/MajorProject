<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function BlogCatList()
    {
        check_access('blog');
        $blogcat = DB::table('post_category')->get();
        return view('admin.blog.category.index', compact('blogcat'));
    }

    public function BlogCatStore(Request $request)
    {
        check_access('blog');
        $validate = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_nep' => 'required|max:255'
        ]);
        
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_nep'] = $request->category_name_nep;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        DB::table('post_category')->insert($data);
        $notification=array(
            'message'=>'Blog Category Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function DeleteBlogCat($id)
    {
        check_access('blog');
        DB::table('post_category')->where('id', $id)->delete();
        $notification=array(
            'message'=>'Blog Category Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditBlogCat($id)
    {
        check_access('blog');
        $blogcatedit = DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.category.edit', compact('blogcatedit'));
    }

    public function UpdateBlogCat(Request $request, $id)
    {
        check_access('blog');
        $validate = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_nep' => 'required|max:255'
        ]);
        
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_nep'] = $request->category_name_nep;
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        DB::table('post_category')->where('id',$id)->update($data);
        $notification=array(
            'message'=>'Blog Category Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.blog.categorylist')->with($notification);
    }

    public function Create()
    {
        check_access('blog');
        $blogcategory = DB::table('post_category')->get();
        return view('admin.blog.create',compact('blogcategory'));
    }

    public function Store(Request $request)
    {
        check_access('blog');
        $validate = $request->validate([
            'post_title_en' => 'required',
            'post_title_nep' => 'required',
            'category_id' => 'required',
            'details_en' => 'required',
            'details_nep' => 'required'
        ]);

        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_nep'] = $request->post_title_nep;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_nep'] = $request->details_nep;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $post_image = $request->file('post_image');
        if ($post_image){
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
            $data['post_image'] ='public/media/post/' .$post_image_name;

            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Post Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $data['post_image'] = '';
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Post Added Without Image',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }   
    }

    public function index()
    {
        check_access('blog');
        $post = DB::table('posts')
                ->join('post_category','posts.category_id','post_category.id')
                ->select('posts.*','post_category.category_name_en','post_category.category_name_nep')
                ->get();
        return view('admin.blog.index',compact('post'));
    }

    public function DeletePost($id)
    {
        check_access('blog');
        $post = DB::table('posts')->where('id',$id)->first();
        $image = $post->post_image;
        if(!empty($image)){
            unlink($image);
        }
        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Post Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditPost($id)
    {
        check_access('blog');
        $post = DB::table('posts')->where('id',$id)->first();
        $blogcategory = DB::table('post_category')->get();
        return view('admin.blog.edit', compact('post','blogcategory'));
    }

    public function UpdatePost(Request $request, $id)
    {
        check_access('blog');
        $validate = $request->validate([
            'post_title_en' => 'required',
            'post_title_nep' => 'required',
            'category_id' => 'required',
            'details_en' => 'required',
            'details_nep' => 'required'
        ]);

        $old_image = $request->old_image;
            
        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_nep'] = $request->post_title_nep;
        $data['category_id'] = $request->category_id;
        $data['details_en'] = $request->details_en;
        $data['details_nep'] = $request->details_nep;
        $data['updated_at'] = date('Y-m-d H:i:s');

        $post_image = $request->file('post_image');
        if ($post_image){
            if(!empty($old_image)){
                unlink($old_image);
            }
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,200)->save('public/media/post/'.$post_image_name);
            $data['post_image'] ='public/media/post/' .$post_image_name;

            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Post Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.blogpost')->with($notification);
        }else{
            $data['post_image'] = $old_image;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Post Updated Without Image',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.blogpost')->with($notification);
        }
    }

    public function AllMessage(){
        check_access('contact');
        $message = DB::table('contact')->get();
        return view('admin.contact.all_message',compact('message'));
    }

    public function ContactMessage($id)
    {
        check_access('contact');
        $message = DB::table('contact')->where('id',$id)->first();
        return view('admin.contact.view_message',compact('message'));
    }
}
