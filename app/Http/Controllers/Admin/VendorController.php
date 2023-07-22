<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $vendors = DB::table('vendors')->get();
        return view('admin.vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company_name' => 'required',
            'company_details' => 'required'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_details'] = $request->company_details;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('vendors')->insert($data);
        $notification=array(
            'message'=>'Vendor Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $vendor = DB::table('vendors')->where('id',$id)->first();
        return view('admin.vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company_name' => 'required',
            'company_details' => 'required'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_details'] = $request->company_details;
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('vendors')->where('id',$id)->update($data);
        $notification=array(
            'message'=>'Vendor Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('all.vendor')->with($notification);
    }

    public function show($id)
    {
        $vendor = DB::table('vendors')->where('id',$id)->first();
        return view('admin.vendor.show',compact('vendor'));
    }

    public function delete($id)
    {
        DB::table('vendors')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Vendor Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
