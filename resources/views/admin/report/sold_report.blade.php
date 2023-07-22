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
          <h5>Sold Product Report</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Sold Product List</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">SN</th>
                  <th class="wd-15p">Product Name</th>
                  <th class="wd-15p">Product Code</th>
                  <th class="wd-15p">Color</th>
                  <th class="wd-15p">Size</th>
                  <th class="wd-15p">Sold Quantity</th>
                  <th class="wd-15p">Unit Price</th>
                  <th class="wd-15p">Total Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product as $key=>$row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->color }}</td>
                        <td>{{ $row->size }}</td>
                        <td>{{ $row->total_qty }}</td>
                        <td>Rs. {{ $row->singleprice }}</td>
                        <td>Rs. {{ $row->singleprice*$row->total_qty }}</td>
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