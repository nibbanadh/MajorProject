<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->leftJoin('minicategories','products.minicategory_id','minicategories.id')
                    ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name','minicategories.minicategory_name')
                    ->orderBy('products.id','desc')
                    ->get();
                   
                   return view('admin.product.index',compact('product'));

    }
 
    public function create(){

        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $vendor = DB::table('vendors')->get();

        return view('admin.product.create',compact('category','brand','vendor'));

    }

    public function GetSubcat($category_id){
        $cat = DB::table('subcategories')->where('category_id',$category_id)->get();
        return json_encode($cat);

    }

    public function GetMinicat($subcategory_id)
    {
        $mini_cat = DB::table('minicategories')->where('subcategory_id', $subcategory_id)->get();
        return json_encode($mini_cat);
    }

    public function store(Request $request){
        
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['unit'] = $request->unit;
        $data['buying_limit'] = $request->buying_limit;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['minicategory_id'] = $request->minicategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['vendor'] = $request->vendor;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend_product'] = $request->trend_product;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

       // return response()->json($data);  
       
        if ($image_one && $image_two && $image_three){
           $image_one_name = hexdec(uniqid()).'.'.'png';
           Image::make($image_one)->resize(600, 600)->encode('png')->save('public/media/product/'.$image_one_name);
           $data['image_one'] ='public/media/product/' .$image_one_name;


           $image_two_name = hexdec(uniqid()).'.'.'png';
           Image::make($image_two)->resize(600, 600)->encode('png')->save('public/media/product/'.$image_two_name);
           $data['image_two'] ='public/media/product/' .$image_two_name;


           $image_three_name = hexdec(uniqid()).'.'.'png';
           Image::make($image_three)->resize(600, 600)->encode('png')->save('public/media/product/'.$image_three_name);
           $data['image_three'] ='public/media/product/' .$image_three_name;

           $product = DB::table('products')->insert($data);
           $notification=array(
            'message'=>'Product Inserted Successfully',
            'alert-type'=>'success'
           );
            return Redirect()->back()->with($notification);
        }

    }

    public function inactive($id)
    {
        DB::table('products')->where('id',$id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Product Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function active($id)
    {
        DB::table('products')->where('id',$id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Product Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function delete($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);
        DB::table('products')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Product Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function ViewProduct($id)
    {
        $product = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('subcategories','products.subcategory_id','subcategories.id')
            ->leftJoin('brands','products.brand_id','brands.id')
            ->leftJoin('minicategories','products.minicategory_id','minicategories.id')
            ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name','minicategories.minicategory_name')
            ->where('products.id',$id)
            ->first();
        return view('admin.product.show',compact('product'));
        // return response()->json($product);
    }

    public function EditProduct($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $vendor = DB::table('vendors')->get();

        return view('admin.product.edit', compact('product','vendor'));
    }

    public function UpdateProductWithoutImage(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['unit'] = $request->unit;
        $data['buying_limit'] = $request->buying_limit;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['minicategory_id'] = $request->minicategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['vendor'] = $request->vendor;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend_product'] = $request->trend_product;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['updated_at'] = date('Y-m-d H:i:s');

        $update = DB::table('products')->where('id',$id)->update($data);
        if($update)
        {
            $notification=array(
                'message'=>'Product Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else{
            $notification=array(
                'message'=>'Nothing To Update',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }
    }

    public function upload_img($image, $old_image)
    {
        $image_name = hexdec(uniqid());
        $img = Image::make($image)->resize(600, 600)->encode('png');
        $upload_path = 'public/media/product/';
        $image_url ='public/media/product/' .$image_name.'.'.'png';

        $success= $img->save($upload_path.$image_name.'.png');

        if($success){
            if($old_image){
                unlink($old_image);
            }            
        }

        return $image_url;
        
    }

    public function UpdateProductImage(Request $request, $id)
    {
        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;

        $data = array();

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;
        
        if($image_one && $image_two == null && $image_three == null)
        {
            $img_url = $this->upload_img($image_one, $old_one);
            $data['image_one'] = $img_url;

            $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else if($image_two && $image_one == null && $image_three == null)
        {
            $img_url = $this->upload_img($image_two, $old_two);
            $data['image_two'] = $img_url;

            $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else if($image_three && $image_two == null && $image_one == null)
        {
            $img_url = $this->upload_img($image_three, $old_three);
            $data['image_three'] = $img_url;

            $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else if($image_one && $image_two && $image_three == null)
        {
            $img_url = $this->upload_img($image_one, $old_one);
            $data['image_one'] = $img_url;
            $img_url1 = $this->upload_img($image_two, $old_two);
            $data['image_two'] = $img_url1;

            $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else if($image_one && $image_three && $image_two == null)
        {
            $img_url = $this->upload_img($image_one, $old_one);
            $data['image_one'] = $img_url;
            $img_url1 = $this->upload_img($image_three, $old_three);
            $data['image_three'] = $img_url1;

            $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else if($image_two && $image_three && $image_one == null)
        {
            $img_url = $this->upload_img($image_two, $old_two);
            $data['image_two'] = $img_url;
            $img_url1 = $this->upload_img($image_three, $old_three);
            $data['image_three'] = $img_url1;

            $productimg = DB::table('products')->where('id',$id)->update([
                'image_two' => $img_url,
                'image_three' => $img_url1
            ]);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else if($image_one && $image_two && $image_three)
        {
            $img_url1 = $this->upload_img($image_one, $old_one);
            $data['image_one'] = $img_url1;

            $img_url2 = $this->upload_img($image_two, $old_two);
            $data['image_two'] = $img_url2;

            $img_url3 = $this->upload_img($image_three, $old_three);
            $data['image_three'] = $img_url3;

            $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Image Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else{
            $notification=array(
                'message'=>'Nothing To Update',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }
    }
    
}
