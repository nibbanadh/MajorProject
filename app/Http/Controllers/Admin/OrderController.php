<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function NewOrder()
    {
        check_access('order');
        $heading= "Pending Order Details";
        $order = DB::table('orders')->where('status',0)->get();

        return view('admin.order.pending',compact('order','heading'));
    }

    public function ViewOrder($id)
    {
        check_access('order');
        $order = DB::table('orders')
                ->join('users','orders.user_id','users.id')
                ->select('orders.*','users.name','users.phone')
                ->where('orders.id',$id)
                ->first();

        $shipping = DB::table('shipping')->where('order_id', $id)->first();
        $details = DB::table('orders_details')
                    ->join('products','orders_details.product_id','products.id')
                    ->select('orders_details.*','products.product_code','products.image_one')
                    ->where('orders_details.order_id', $id)
                    ->get();
        
        return view('admin.order.view_order', compact('order','shipping','details'));
    }

    public function PaymentAccept($id)
    {
        check_access('order');
        DB::table('orders')->where('id',$id)->update(['status'=>1]);
        $notification=array(
            'message'=>'Payment Accepted',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.neworder')->with($notification);
    }

    public function PaymentCancel($id)
    {
        check_access('order');
        DB::table('orders')->where('id',$id)->update(['status'=>4]);
        $notification=array(
            'message'=>'Order Cancel',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.neworder')->with($notification);
    }

    public function DeliveryProcess($id)
    {
        check_access('order');
        DB::table('orders')->where('id',$id)->update(['status'=>2]);
        $notification=array(
            'message'=>'Order Process for Delivery',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.accept.payment')->with($notification);
    }

    public function DeliveryDone(Request $request)
    {
        check_access('order');
        $id = $request->order_id;
        $delivery_by = $request->delivery_by;

        $product = DB::table('orders_details')->where('order_id',$id)->get();
        foreach($product as $row) {
            DB::table('products')
                ->where('id',$row->product_id)
                ->update(['product_quantity' => DB::raw('product_quantity-'.$row->quantity)]);

            $check_product = DB::table('products')->where('id',$row->product_id)->first();
            if($check_product->product_quantity == 0)
            {
                DB::table('products')->where('id',$check_product->id)->update(['status'=> 0]);
            }
            
        }

        DB::table('orders')->where('id',$id)->update(['status'=>3,'delivery_by'=> $delivery_by]);

        $notification=array(
            'message'=>'Product Delivery Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.success.delivery')->with($notification);
    }

    public function AcceptPayment()
    {
        check_access('order');
        $heading= "Payment Acceptance Details";
        $order = DB::table('orders')->where('status',1)->get();

        return view('admin.order.pending',compact('order','heading'));
    }

    public function CancelOrder()
    {
        check_access('order');
        $heading= "Cancelled Order Details";
        $order = DB::table('orders')->where('status',4)->get();

        return view('admin.order.pending',compact('order','heading'));
    }

    public function ProcessOrder()
    {
        check_access('order');
        $heading= "Delivery Processing Order Details";
        $order = DB::table('orders')->where('status',2)->get();

        return view('admin.order.pending',compact('order','heading'));
    }

    public function SuccessDelivery()
    {
        check_access('order');
        $heading= "Delivered Order Details";
        $order = DB::table('orders')->where('status',3)->get();

        return view('admin.order.pending',compact('order','heading'));
    }

    public function seo()
    {
        check_access('other');
        $seo = DB::table('seo')->first();
        return view('admin.coupon.seo',compact('seo'));
    }

    public function UpdateSeo(Request $request){
        check_access('other');

        $id = $request->id;

        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['google_analytics'] = $request->google_analytics;
        $data['bing_analytics'] = $request->bing_analytics;
        if(!empty($id)){
            DB::table('seo')->where('id',$id)->Update($data);
        }else{
            DB::table('seo')->insert($data);
        }
        $notification=array(
            'message'=>'Seo Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


    }
    
    public function InvoiceVerify(Request $request){
        check_access('order');
        $id= $request->order_id;
        $post_image = $request->file('invoice_verify');
        if ($post_image!=NULL && $id!=NULL){
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,200)->save('public/media/invoice/'.$post_image_name);
            $data['invoice_verify'] ='public/media/invoice/' .$post_image_name;

            DB::table('orders')->where('id',$id)->Update(['invoice_verify' => $data['invoice_verify']]);
            $notification=array(
                'message'=>'Invoice Reciept Saved Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Failed To Save Invoice Reciept',
                'alert-type'=>'warning'
            );
            return Redirect()->back()->with($notification);  
        }
    }
}
