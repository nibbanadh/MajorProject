<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $title="Home";
        return view('home', compact('title'));
    }

    public function changePassword(){
        $title="Change Password";
        return view('auth.changepassword',compact('title'));
    }

    public function updatePassword(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();  
                      $notification=array(
                        'message'=>'Password Changed Successfully ! Now Login with Your New Password',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('login')->with($notification); 
                 }else{
                    $notification=array(
                      'message'=>'New password and Confirm Password not matched!',
                      'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                 }     
      }else{
        $notification=array(
                'message'=>'Old Password not matched!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }

    }

    public function Logout()
    {
        // $logout= Auth::logout();
            Auth::logout();
            $notification=array(
                'message'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->route('login')->with($notification);
       

    }

    public function ViewOrder($id)
    {
      $title="Orders";
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
      
      return view('pages.view_order', compact('order','shipping','details','title'));
    }

    public function editUser(){
      $title="Edit Profile";
      $user=User::find(Auth::id());
      return view('auth.edit',compact('user','title'));
    }

    public function updateUser(Request $request){
      $user=User::find(Auth::id());
      $data['name']= $request->name;
      $data['phone']= $request->phone;
      $data['email']= $request->email;

      $image= $request->file('image');
      if(!empty($user->avatar)){
        unlink($user->avatar);
      }
      
      $image_name = hexdec(uniqid());
      $ext = strtolower($image->getClientOriginalExtension());
      $image_full_name = $image_name.'.'.$ext;
      $upload_path = 'public/frontend/images/profile/';
      $image_url = $upload_path.$image_full_name;
      $success = $image->move($upload_path,$image_full_name);
      $data['avatar'] = $image_url;

      DB::table('users')->where('id',$user->id)->update($data);

      $notification=array(
          'message'=>'User Updated Successfully.',
          'alert-type'=>'success'
      );

      return Redirect()->back()->with($notification);

    }

}
