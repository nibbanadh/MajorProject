@extends('admin.admin_layouts')

@section('admin_content')
{!!$style!!}

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <!-- <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Onnepa</a>
        <a class="breadcrumb-item" href="">Category</a>
        <span class="breadcrumb-item active">Category List</span>
      </nav> -->

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Admin User Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Admin List
            <a href="{{route('create.admin')}}" class="btn btn-sm btn-warning" style="float:right;" da>Add New User</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Phone</th>
                  <th class="wd-15p">Access</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->phone }}</td>
                        <td class="access_block">
                          @if($row->category == 1)
                            <span class="badge badge-danger">Category</span>
                          @else
                          @endif
                          @if($row->product == 1)
                            <span class="badge badge-info">Product</span>
                          @else
                          @endif
                          @if($row->blog == 1)
                            <span class="badge badge-warning">Blog</span>
                          @else
                          @endif
                          @if($row->other == 1)
                            <span class="badge badge-success">Other</span>
                          @else
                          @endif
                          @if($row->order == 1)
                            <span class="badge badge-info">Order</span>
                          @else
                          @endif
                          @if($row->report == 1)
                            <span class="badge badge-danger">Report</span>
                          @else
                          @endif
                          @if($row->setting == 1)
                            <span class="badge badge-warning">Setting</span>
                          @else
                          @endif
                          @if($row->contact == 1)
                            <span class="badge badge-success">Contact</span>
                          @else
                          @endif
                          @if($row->comment == 1)
                            <span class="badge badge-info">Comment</span>
                          @else
                          @endif
                          @if($row->return == 1)
                            <span class="badge badge-warning">Return</span>
                          @else
                          @endif
                          @if($row->coupon == 1)
                            <span class="badge badge-danger">Coupon</span>
                          @else
                          @endif
                          @if($row->role == 1)
                            <span class="badge badge-success">Role</span>
                          @else
                          @endif
                          @if($row->stock == 1)
                            <span class="badge badge-info">Stock</span>
                          @else
                          @endif
                          @if($row->vendor == 1)
                            <span class="badge badge-info">Vendor</span>
                          @else
                          @endif
                        </td>
                        <td>
                            <a href="{{ URL::to('edit/admin/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{ URL::to('delete/admin/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
          
        </div><!-- card -->

      </div><!-- sl-pagebody -->
      
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection