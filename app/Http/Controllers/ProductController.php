<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Database\Query\Builder;
use Stripe\Product;

class ProductController extends Controller
{
    public function ProductView($id, $product_name)
    {
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('minicategories','products.minicategory_id','minicategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','subcategories.subcategory_name','minicategories.minicategory_name','brands.brand_name')
                    ->where('products.id',$id)
                    ->first()
        ;

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);
        $title= $product->product_name;
        $meta_title= $product->product_name;
        $meta_desc= $product->product_details;
        $meta_image= $product->image_one;

        return view('pages.product_details', compact('product','product_color','product_size','title','meta_title','meta_desc','meta_image'));
    }

    public function AddCart(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        
        $data = array(); 

        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = $request->qty;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['color'] = $request->color;
        $data['options']['size'] = $request->size;

        if($product->discount_price == NULL)
        {
            $data['price'] = $product->selling_price;
        }else {
            $data['price'] = $product->discount_price;
        }
        
        Cart::add($data);
        $notification=array(
            'message'=>'Product Successfully Added on Your Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function ProductsView($id)
    {
        $title="All Products";
        $products = DB::table('products')->where('minicategory_id',$id)->where('status',1)->orderByRaw('coalesce(discount_price, selling_price) asc')->paginate(30);
        $minicategory = DB::table('minicategories')->where('id', $id)->first();
        $brands = DB::table('products')->where('minicategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        $catalog = DB::table('categories')->get();
        $category = DB::table('subcategories')->get();
        $minicategory_id = $id;
        return view('pages.all_products', compact('products','minicategory','catalog','brands','category','minicategory_id','title'));
    }

    public function SubcategoryView($id)
    {
        $title="Sub Categories";
        $products = DB::table('products')->where('subcategory_id',$id)->where('status',1)->orderByRaw('coalesce(discount_price, selling_price) asc')->paginate(30);
        $subcategory = DB::table('subcategories')->where('id', $id)->first();
        $brands = DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        $subcategory_id = $id;
        return view('pages.all_subcategory', compact('products','subcategory','brands','subcategory_id','title'));
    }

    public function CategoryView($id)
    {
        $title="Categories";
        $products = DB::table('products')->where('category_id',$id)->where('status',1)->orderByRaw('coalesce(discount_price, selling_price) asc')->paginate(30);
        $category = DB::table('categories')->where('id', $id)->first();
        $category_id = $id;
        return view('pages.all_category', compact('products','category','category_id','title'));
    }

    public function price_filter(Request $request)
    { 
        $title="Product List"; 
        $id = $request->id;
        $order = $request->order;

        if($request->types == 'catalog')
        {
            $products = DB::table('products')->where('category_id',$id)->where('status',1)->orderByRaw('coalesce(discount_price, selling_price) '.$order)->paginate(30);
        } else if($request->types == 'category') {
            $products = DB::table('products')->where('subcategory_id',$id)->where('status',1)->orderByRaw('coalesce(discount_price, selling_price) '.$order)->paginate(30);
        } else {
            $products = DB::table('products')->where('minicategory_id',$id)->where('status',1)->orderByRaw('coalesce(discount_price, selling_price) '.$order)->paginate(30);
        }
        

        return view('pages.product_list',compact('products','title'));
    }
}
