<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontController extends Controller
{
    public function index()
    {
        $catalog = DB::table('categories')->get();
        $featured = DB::table('products')->where('status',1)->orderBy('id','desc')->limit(12)->get();
        $trend = DB::table('products')->where('status',1)->where('trend_product',1)->orderBy('id','desc')->limit(8)->get();
        $best = DB::table('products')->where('status',1)->where('best_rated',1)->orderBy('id','desc')->limit(8)->get();
        $mid = DB::table('products')
                ->join('categories','products.category_id','categories.id')
                ->leftJoin('brands','products.brand_id','brands.id')
                ->select('products.*','brands.brand_name','categories.category_name')
                ->where('products.status',1)
                ->where('products.mid_slider',1)->orderBy('products.id','desc')->limit(3)
                ->get()
        ;        

        $hot = DB::table('products')
                ->leftJoin('brands','products.brand_id','brands.id')
                ->select('products.*','brands.brand_name')
                ->where('products.status',1)
                ->where('products.hot_deal',1)
                ->orderBy('products.id','desc')->limit(3)
                ->get()
        ; 
        
        $tablets = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->select('products.*','categories.category_name','subcategories.subcategory_name')
                    ->where('products.status',1)
                    ->where('categories.category_name','Electronics Devices')
                    ->where('subcategories.subcategory_name','Tablets')
                    ->orderBy('products.id','desc')->limit(8)
                    ->get()
        ; 
        
        $mobiles = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->select('products.*','categories.category_name','subcategories.subcategory_name')
                    ->where('products.status',1)
                    ->where('categories.category_name','Electronics Devices')
                    ->where('subcategories.subcategory_name','Mobiles')
                    ->orderBy('products.id','desc')->limit(8)
                    ->get()
        ;

        $laptops = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->select('products.*','categories.category_name','subcategories.subcategory_name')
                    ->where('products.status',1)
                    ->where('categories.category_name','Electronics Devices')
                    ->where('subcategories.subcategory_name','Laptops')
                    ->orderBy('products.id','desc')->limit(8)
                    ->get()
        ;

        $brand_logos = DB::table('brands')->get();
        
        return view('pages.index',compact('catalog','featured','trend','best','hot','mid','tablets','mobiles','laptops','brand_logos'));
    }

    public function store_newslater(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|unique:newslaters|max:55',
        ]);

        $data = array();
        $data['email'] = $request->email;
        DB::table('newslaters')->insert($data);
        $notification=array(
            'message'=>'Thanks for Subscribing',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function OrderTracking(Request $request)
    {
        $code = $request->code;
        $track = DB::table('orders')->where('status_code',$code)->first();

        if ($track) {
            return view('pages.tracking',compact('track'));
        }else {
            $notification=array(
            'message'=>'Invalid Status Code',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
        }
    }

    public function terms_conditions()
    {
        $title="Terms & Condition";
        return view('terms_condition','title');
    }
}
