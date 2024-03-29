<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }

    public function storecategory(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification=array(
            'message'=>'Catalog Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Deletecategory($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Catalog Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Editcategory($id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category',compact('category'));
    }

    public function Updatecategory(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
        ]);
        $category = new Category();
        
        $category->where('id',$id)->update([
            'category_name' => $request->category_name,
        ]);
        
        $notification=array(
            'message'=>'Catalog Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('categories')->with($notification);
        
    }
}
