<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Minicategory;
use DB;

class MiniCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
           check_access('category');
           return $next($request);
        });
    }

    public function minicategories()
    {
        $catalogs = DB::table('categories')->get();
        $categories = DB::table('subcategories')->get();
        $minicat = DB::table('minicategories')
                    ->join('subcategories','minicategories.subcategory_id','subcategories.id')
                    ->join('categories','subcategories.category_id','categories.id')
                    ->select('minicategories.*','categories.category_name','subcategories.subcategory_name')
                    ->get();
        return view('admin.category.minicategory', compact('catalogs','categories','minicat'));
    }

    public function storeminicat(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'minicategory_name' => 'required',
        ]);
        $minicategory = new Minicategory();
        $minicategory->category_id = $request->category_id;
        $minicategory->subcategory_id = $request->subcategory_id;
        $minicategory->minicategory_name = $request->minicategory_name;
        $minicategory->save();
        $notification=array(
            'message'=>'Sub Category Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Deleteminicat($id)
    {
        Minicategory::where('id',$id)->delete();
        $notification=array(
            'message'=>'Sub Category Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Editminicat($id)
    {
        $minicat = DB::table('minicategories')->where('id',$id)->first();
        $catalog = DB::table('categories')->get();
        $category = DB::table('subcategories')->get();
        return view('admin.category.edit_minicategory', compact('minicat','category','catalog'));
    }

    public function Updateminicat(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'minicategory_name' => 'required',
        ]);

        $minicategory = new Minicategory();
        
        $minicategory->where('id',$id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'minicategory_name' => $request->minicategory_name,
        ]); 
        $notification=array(
            'message'=>'Sub Category Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('mini.categories')->with($notification);
    }
}
