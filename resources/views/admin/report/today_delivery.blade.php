@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <!-- <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Onnepa</a>
        <a class="breadcrumb-item" href="">Brand</a>
        <span class="breadcrumb-item active">Brand List</span>
      </nav> -->

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Today Delivery Report</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Today Delivery Report</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">SN</th>
                  <th class="wd-15p">Payment Type</th>
                  <th class="wd-15p">Transaction ID</th>
                  <th class="wd-15p">Subtotal</th>
                  <th class="wd-15p">Delivery</th>
                  <th class="wd-15p">Total</th>
                  <th class="wd-15p">Date</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->payment_type }}</td>
                        <td>{{ $row->blnc_transection }}</td>
                        <td>{{ $row->subtotal }}</td>
                        <td>{{ $row->shipping }}</td>
                        <td>{{ $row->total }}</td>
                        <td>{{ $row->date }}</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td>
                            <a href="{{ URL::to('admin/view/order/'.$row->id) }}" class="btn btn-sm btn-info">View</a>
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