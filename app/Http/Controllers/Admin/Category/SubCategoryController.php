<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Subcategory;
use DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
           check_access('category');
           return $next($request);
        });
    }

    public function subcategories()
    {
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')
                    ->join('categories','subcategories.category_id','categories.id')
                    ->select('subcategories.*','categories.category_name')
                    ->get();
        return view('admin.category.subcategory', compact('category','subcat'));
    }

    public function storesubcat(Request $request)
    { 
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();
        $notification=array(
            'message'=>'Category Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function DeleteSubcat($id)
    {
        Subcategory::where('id',$id)->delete();
        $notification=array(
            'message'=>'Category Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditSubcat($id)
    {
        $subcat = DB::table('subcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        return view('admin.category.edit_subcategory', compact('subcat','category'));
    }

    public function UpdateSubcat(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        $subcategory = new Subcategory();
        
        $subcategory->where('id',$id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
        ]); 
        $notification=array(
            'message'=>'Category Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('sub.categories')->with($notification);
    }
}
