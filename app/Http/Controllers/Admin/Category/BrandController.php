<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function brand()
    {
        $brand = Brand::all();
        return view('admin.category.brand',compact('brand'));
    }

    public function storebrand(Request $request)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $image = $request->file('brand_logo');
        if($image)
        {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            $brand->brand_logo = $image_url;
            $brand->save();
            $notification=array(
                'message'=>'Brand Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $brand->save();
            $notification=array(
                'message'=>'Brand Added Without Logo',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function DeleteBrand($id)
    {
        $data = DB::table('brands')->where('id',$id)->first();
        $image = $data->brand_logo;
        unlink($image);
        $brand = DB::table('brands')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Brand Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditBrand($id)
    {
        $brand = DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brand',compact('brand'));
    }

    public function UpdateBrand(Request $request, $id)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);
        
        $old_logo = $request->old_logo;
        $brand = new Brand();
        $image = $request->file('brand_logo');
        if($image)
        {
            if(!empty($old_logo)){
                unlink($old_logo);
            }
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            $brand->where('id',$id)->update([
                'brand_name' => $request->brand_name,
                'brand_logo' => $image_url,
            ]);
            $notification=array(
                'message'=>'Brand Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);
        }else{
            $brand->where('id',$id)->update([
                'brand_name' => $request->brand_name,
            ]);
            $notification=array(
                'message'=>'Brand Updated Without Logo',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);
        }
    }
}
