<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Response;
use Auth;
use Session;

class CartController extends Controller
{
    public function addCart($id)
    {
       $product = DB::table('products')->where('id', $id)->first();
        
       $data = array(); 

        if($product->discount_price == NULL)
        {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return \Response::json(['success'=> 'Successfully Added on your Cart']);
        }else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return \Response::json(['success'=> 'Successfully Added on your Cart']);
        }
    }

    public function check()
    {
        $content = Cart::content();
        return response()->json($content);
    }

    public function ShowCart()
    {
        $title="Cart";
        $cart = Cart::content();
        return view('pages.cart', compact('cart','title'));
    }

    public function removeCart($id)
    {
        Cart::remove($id);
        $notification=array(
            'message'=>'Product Removed from Your Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->productId;
        $qty = $request->qty;

        Cart::update($rowId, $qty);
        $notification=array(
            'message'=>'Product Quantity Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function removeAllCart()
    {
        Cart::destroy();
        $notification=array(
            'message'=>'All Product Removed Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function ViewProduct($id)
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

        return response::json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function insertCart(Request $request)
    {
        $id = $request->product_id;
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

    public function Checkout()
    {
        if(Auth::check())
        {
            $title= "Checkout";
            $cart = Cart::content();
            return view('pages.checkout', compact('cart','title'));
        }else{
            $notification=array(
                'message'=>'Please, Login with your Account',
                'alert-type'=>'warning'
            );
            return Redirect()->route('login')->with($notification);
        }
    }

    public function wishlist()
    {
        $title="Wish List";
        $user_id = Auth::id();
        $product = DB::table('wishlists')
                    ->join('products','wishlists.product_id','products.id')
                    ->select('products.*','wishlists.user_id')
                    ->where('wishlists.user_id',$user_id)
                    ->get()
        ;
        return view('pages.wishlist', compact('product','title'));
    }

    public function ApplyCoupon(Request $request)
    {
        $coupon = $request->coupon;

        $check = DB::table('coupons')->where('coupon', $coupon)->first();
        if($check){
            Session::put('coupon',[
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => Cart::Subtotal()-$check->discount,
            ]);
            $notification=array(
                'message'=>'Coupon Apply Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Invalid Coupon',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function RemoveCoupon()
    {
        Session::forget('coupon');
        $notification=array(
            'message'=>'Coupon Remove Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function PaymentPage()
    {
        $title= "Payment";
        $cart = Cart::Content();
        
        return view('pages.payment', compact('cart','title'));
    }

    public function Search(Request $request){
        $title="Search Result";
        $item = $request->search;

        $products = DB::table('products')
        ->where('product_name','LIKE',"%$item%")
        ->where('status',1)
        ->paginate(20);

        return view('pages.search',compact('products','title'));

    }

    public function PreviousAddress()
    {
        $user_id = Auth::user()->id;
        $address = DB::table('orders')->latest('orders.id')
                ->where('orders.user_id',$user_id)
                ->select('shipping.*')
                ->join('shipping','orders.id','shipping.order_id')
                ->first()
        ;
        return json_encode($address);
                    
    }
}
