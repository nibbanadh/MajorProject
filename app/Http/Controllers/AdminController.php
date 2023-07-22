<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Events\OrderReceived;
use App\Notifications\OrderNotification;
use Illuminate\Notifications\Notification;
use App\User;
use DB;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.home');
  }

  public function ChangePassword()
  {
      return view('admin.auth.passwordchange');
  }

  public function Update_pass(Request $request)
  {
    $password=Auth::user()->password;
    $oldpass=$request->oldpass;
    $newpass=$request->password;
    $confirm=$request->password_confirmation;
    if (Hash::check($oldpass,$password)) {
      if ($newpass === $confirm) {
          $user=Admin::find(Auth::id());
          $user->password=Hash::make($request->password);
          $user->save();
          Auth::logout();  
          $notification=array(
            'message'=>'Password Changed Successfully ! Now Login with Your New Password',
            'alert-type'=>'success'
          );
          return Redirect()->route('admin.login')->with($notification); 
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

  public function logout()
  {
    Auth::logout();
    $notification=array(
        'message'=>'Successfully Logout',
        'alert-type'=>'success'
    );
    return Redirect()->route('admin.login')->with($notification);
  }

  public function ClearNotification()
  {
    $notifications = DB::table('notifications')->get();
    foreach($notifications as $row)
    {
      $user = User::find($row->notifiable_id);
      $user->notifications()->delete();
    }

    $notification=array(
      'message'=>'Cleared All Notification',
      'alert-type'=>'success'
    );
    return Redirect('/admin/home')->with($notification);
  }

  public function ReadNotification(Request $request)
  {
    $id = $request->id;
    $user_id = $request->user_id;

    $user = User::find($user_id);
    foreach ($user->unreadNotifications as $notification) {
      if ($notification->id == $id){
        $notification->markAsRead();
      }
    }
    return 0;
  }

  public function countNotification(Request $request)
  {
    $unread_notifications = DB::table('notifications')->whereNull('read_at')->get();
    $count_notif = count($unread_notifications);
    return $count_notif;
  }

  public function ajax_notification()
  {
    return view('admin.notification');
  }


}
