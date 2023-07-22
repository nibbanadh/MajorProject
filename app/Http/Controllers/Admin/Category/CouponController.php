<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Coupon;
use Mail;
use DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon()
    {
        
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon', compact('coupon'));
    }

    public function storecoupon(Request $request)
    {
        
        $coupon = new Coupon();
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        $notification=array(
            'message'=>'Coupon Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function DeleteCoupon($id)
    {
        
        DB::table('coupons')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Coupon Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditCoupon($id)
    {
        
        $coupon = DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit_coupon', compact('coupon'));
    }

    public function UpdateCoupon(Request $request, $id)
    {
        
        $coupon = new Coupon();
        $coupon->where('id',$id)->update([
            'coupon' => $request->coupon,
            'discount' => $request->discount,
        ]);
        $notification=array(
            'message'=>'Coupon Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.coupon')->with($notification);
    }

    public function Newslater()
    {
        $sub = DB::table('newslaters')->get();
        return view('admin.coupon.newslater',compact('sub'));  
    }

    public function DeleteNewslater($id)
    {
        DB::table('newslaters')->where('id', $id)->delete();
        $notification=array(
            'message'=>'Subscriber Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EmailSubscriber(Request $request){
        $emails= $request->email_id;

        return view('admin.coupon.email',compact('emails'));
    }

    public function EmailSuccess(Request $request){
        $to= explode(',',$request->email_to);
        $subject= $request->email_subject;
        $body= $request->email_body;

        Mail::send([], [], function($message) use ($to,$subject,$body) {
            $message->to($to);
            $message->subject($subject);
            $message->setBody($body, 'text/html');
        });
        // check for failures
        if (Mail::failures()) {
            $notification=array(
            'message'=>'Mail Sending Failed',
            'alert-type'=>'danger'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
            'message'=>'Mail Sent Successfully',
            'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }
}
