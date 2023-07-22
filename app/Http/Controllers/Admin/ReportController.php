<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
    $this->middleware(function ($request, $next) {
       check_access('report');
       return $next($request);
    });
  }

  public function TodayOrder(){
    // dd(Auth::user());
    // dd($request->user()->name);
    $today = date('d-m-y');
    $order= DB::table('orders')->where('status', 0)->where('date', $today)->get();

    return view('admin.report.today_order',compact('order'));
  }

  public function TodayDelivery(){
    $today = date('d-m-y');
    $order= DB::table('orders')->where('status', 3)->where('date', $today)->get();

    return view('admin.report.today_delivery',compact('order'));
  }

  public function ThisMonth(){
    $month = date('F');
    $year = date('Y');
    $order= DB::table('orders')->where('status', 3)->where('month', $month)->where('year', $year)->get();

    return view('admin.report.this_month',compact('order'));
  }

  public function SearchReport(){
    return view('admin.report.search_report');

  }

  public function SearchByYear(Request $request){
    $year = $request->year;
    $status= $request->status;
    if($status==5){
      $total= DB::table('orders')->where('return_order', 2)->where('year', $year)->sum('total');
      $order= DB::table('orders')->where('return_order', 2)->where('year', $year)->get(); 
    }else{
      $total= DB::table('orders')->where('status', $status)->where('year', $year)->sum('total');
      $order= DB::table('orders')->where('status', $status)->where('year', $year)->get(); 
    }

    return view('admin.report.search_result',compact('order','total'));
  }

  public function SearchByMonth(Request $request){
    $month = $request->month;
    $status= $request->status;
    if($status==5){
      $total= DB::table('orders')->where('return_order', 2)->where('month', $month)->sum('total');
      $order= DB::table('orders')->where('return_order', 2)->where('month', $month)->get(); 
    }else{
      $total= DB::table('orders')->where('status', $status)->where('month', $month)->sum('total');
      $order= DB::table('orders')->where('status', $status)->where('month', $month)->get(); 
    }

    return view('admin.report.search_result',compact('order','total'));
  }

  public function SearchByDate(Request $request){
    $date = date('d-m-y',strtotime($request->date));
    $status= $request->status;
    if($status==5){
      $total= DB::table('orders')->where('return_order', 2)->where('date', $date)->sum('total');
      $order= DB::table('orders')->where('return_order', 2)->where('date', $date)->get(); 
    }else{
      $total= DB::table('orders')->where('status', $status)->where('date', $date)->sum('total');
      $order= DB::table('orders')->where('status', $status)->where('date', $date)->get(); 
    }

    return view('admin.report.search_result',compact('order','total'));
  }

  // if (!function_exists('dbDynamic')) {
    public function dbDynamic($option, $state)
    {
        config([$option => $state]);
        DB::purge(env('DB_CONNECTION'));

        return DB::reconnect(env('DB_CONNECTION'));
    }
// }

  
  public function SoldProduct()
  {
    $this->dbDynamic('database.connections.mysql.strict', false);
    $product = DB::table('orders')
              ->join('orders_details','orders.id','orders_details.order_id')
              ->join('products','orders_details.product_id','products.id')
              ->select(DB::raw('sum(orders_details.quantity) as total_qty'),'orders_details.product_id','orders_details.product_name','orders_details.singleprice','orders_details.color','orders_details.size','products.product_code')
              ->groupBy('orders_details.product_id')
              ->where('orders.status',3)
              ->where('orders.return_order',0)
              ->get();

    return view('admin.report.sold_report', compact('product'));
  }
  
}
