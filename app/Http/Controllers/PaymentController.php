<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cart;
use Session;
use Mail;
use App\Mail\InvoiceMail;
use App\Events\OrderReceived;
use App\Notifications\OrderNotification;

class PaymentController extends Controller
{
    public function Payment(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'payment' => 'required',
        ]);

        $data = array();

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
        $data['payment_id'] = $request->payment_id;
        
        if($request->payment == 'stripe')
        {

            return view('pages.payment.stripe',compact('data'));

        }else if($request->payment == 'bank') {

            return view('pages.payment.bank',compact('data'));

        }else if($request->payment == 'oncash') {
            
            return view('pages.payment.oncash',compact('data'));

        }else{
            echo "cash on delivery";
        }
    }

    public function StripeCharge(Request $request)
    {
        $email = Auth::user()->email;
        $total = $request->total;

        // Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey('sk_test_51IdYgwJ3UQJURVWz0TFcfkCezZe19GsbqSaKQAxDnzsiBNhjWRpFVh3k83YCJWysalIvL5oRGP1UAzl3mbszLyYP00G2G6uTvf');

		// Token is created using Checkout or Elements!
		// Get the payment token ID submitted by the form:
		$token = $_POST['stripeToken'];

		$charge = \Stripe\Charge::create([
		    'amount' => $total,
		    'currency' => 'usd',
		    'description' => 'Product payment details',
		    'source' => $token,
		    'metadata' => ['order_id' => uniqid()],
		]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['blnc_transection'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);

        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }

        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);

        // Mail send to user for Invoice
        Mail::to($email)->send(new invoiceMail($data));

        // insert shipping table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        // insert order details

        $content = Cart::Content();
        $details = array();

        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty*$row->price;
            DB::table('orders_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification=array(
            'message'=>'Order process Successfully',
            'alert-type'=>'success'
        );

        // trigger event when order is done
        event(new OrderReceived('hello from event'));

        return Redirect()->to('/')->with($notification);

    }

    public function OnCash(Request $request)
    {
        $email = Auth::user()->email;

        $data = array();
        $data['user_id'] = Auth::id();  
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);

        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['payment_id'] = $request->payment_id;
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);

        // Mail send to user for Invoice
        Mail::to($email)->send(new invoiceMail($data));
        // insert shipping table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        // insert order details

        $content = Cart::Content();
        $details = array();

        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty*$row->price;
            DB::table('orders_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification=array(
            'message'=>'Order process Successfully',
            'alert-type'=>'success'
        );

        // trigger event when order is done
        $notify = array();

        $user = Auth::user();

        $notify['user_id'] = Auth::id();
        $notify['order_id'] = $order_id;
        $notify['total_amt'] = $request->total;
        $notify['date'] = date('d F Y, h:i A');
        
        $user->notify(new OrderNotification($notify));
        event(new OrderReceived($notify));

        return Redirect()->to('/')->with($notification);
    }

    public function OnBank(Request $request)
    { 
        $email = Auth::user()->email;

        $data = array();
        $data['user_id'] = Auth::id();  
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);

        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['payment_id'] = $request->payment_id;
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);

        // Mail send to user for Invoice
        Mail::to($email)->send(new invoiceMail($data));
        // insert shipping table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        // insert order details

        $content = Cart::Content();
        $details = array();

        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty*$row->price;
            DB::table('orders_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification=array(
            'message'=>'Order process Successfully',
            'alert-type'=>'success'
        );

        // trigger event when order is done
        $notify = array();

        $user = Auth::user();

        $notify['user_id'] = Auth::id();
        $notify['order_id'] = $order_id;
        $notify['total_amt'] = $request->total;
        $notify['date'] = date('d F Y, h:i A');
        
        $user->notify(new OrderNotification($notify));
        event(new OrderReceived($notify));

        return Redirect()->to('/')->with($notification);
    }

    public function SuccessList()
    {
        $order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->limit(6)->get();

        return view('pages.return_order',compact('order'));
    }

    public function RequestReturn(Request $request)
    {
        $order_id = $request->order_id;
        $return_reason = $request->return_reason;
        DB::table('orders')->where('id',$order_id)->update([
            'return_order'=>1,
            'return_reason'=>$return_reason,
        ]);
        $notification=array(
            'message'=>'Order Return Requested',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function CancelOrder($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>4]);
        $notification=array(
            'message'=>'Order Cancelled Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
