<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserRoleController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function UserRole(){
        check_access('role');
        $user = DB::table('admins')->where('type',2)->get();
        $style= "<style>.access_block{
            display: contents;
        }
        .access_block>span{
            margin:1.5px;
        }
        </style>";

        return view('admin.role.all_role',compact('user','style'));
    }

    public function UserCreate(){
        check_access('role');
        return view('admin.role.create_role');
    }

    public function UserStore(Request $request){
        check_access('role');
        $data= array();
        $data['name']= $request->name;
        $data['phone']= $request->phone;
        $data['email']= $request->email;
        $data['password']= Hash::make($request->password);
        $data['category']= $request->category;
        $data['product']= $request->product;
        $data['order']= $request->order;
        $data['other']= $request->other;
        $data['blog']= $request->blog;
        $data['report']= $request->report;
        $data['setting']= $request->setting;
        $data['coupon']= $request->coupon;
        $data['role']= $request->role;
        $data['return']= $request->return;
        $data['contact']= $request->contact;
        $data['comment']= $request->comment;
        $data['stock']= $request->stock;
        $data['vendor']= $request->vendor;
        $data['type']= 2;

        DB::table('admins')->insert($data);

        $notification=array(
            'message'=>'Child Admin Inserted Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function UserEdit($id){
        check_access('role');
        $user = DB::table('admins')->where('id',$id)->first();

        return view('admin.role.edit_role',compact('user'));
    }

    public function UserDelete($id){
        check_access('role');
        DB::table('admins')->where('id',$id)->delete();


        $notification=array(
            'message'=>'Child Admin Deleted Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function UserUpdate(Request $request){
        check_access('role');
        $id= $request->id;
        $data= array();
        $data['name']= $request->name;
        $data['phone']= $request->phone;
        $data['email']= $request->email;
        $data['category']= $request->category;
        $data['product']= $request->product;
        $data['order']= $request->order;
        $data['other']= $request->other;
        $data['blog']= $request->blog;
        $data['report']= $request->report;
        $data['setting']= $request->setting;
        $data['coupon']= $request->coupon;
        $data['role']= $request->role;
        $data['return']= $request->return;
        $data['contact']= $request->contact;
        $data['comment']= $request->comment;
        $data['stock']= $request->stock;
        $data['vendor']= $request->vendor;

        DB::table('admins')->where('id',$id)->update($data);

        $notification=array(
            'message'=>'Child Admin Updated Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function ProductStock()
    {
        check_access('stock');
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->leftJoin('minicategories','products.minicategory_id','minicategories.id')
                    ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name','minicategories.minicategory_name')
                    ->get()
        ;
          
        return view('admin.stock.stock',compact('product'));
    }

    public function EmptyStock()
    {
        check_access('stock');
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->leftJoin('minicategories','products.minicategory_id','minicategories.id')
                    ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name','minicategories.minicategory_name')
                    ->where('product_quantity',0)
                    ->get()
        ;
        return view('admin.stock.empty_stock',compact('product'));
    }

    public function EmptyStockUpdate(Request $request)
    {
        check_access('stock');
        $product_id = $request->product_id;
        $qty = $request->product_quantity;

        DB::table('products')->where('id',$product_id)->update([
            'product_quantity' => $qty,
            'status' => 1,
        ]);

        $notification=array(
            'message'=>'Stock Quantity Updated Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}
