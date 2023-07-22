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
            <h5>Empty Stock Product</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Empty Stock Product List</h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table scrollable display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Product Code</th>
                        <th class="wd-15p">Product Name</th>
                        <th class="wd-15p">Image </th>
                        <th class="wd-20p">Catelog</th>
                        <th class="wd-20p">Category</th>
                        <th class="wd-20p">Subcategory</th>
                        <th class="wd-20p">Brand</th>
                        <th class="wd-20p">Quantity</th>
                        <th class="wd-20p">Status</th>
                        <th class="wd-20p">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($product as $row)
                      <tr>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>

                        <td>{{ $row->category_name }}</td>
                        <td>{{ $row->subcategory_name }}</td>
                        <td>{{ $row->minicategory_name }}</td>
                        <td>{{ $row->brand_name }}</td>
                        <td>{{ $row->product_quantity }}</td>
                        <td>

                            @if($row->status ==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endif

                        </td>
                        <td>
                            <button type="button" id="{{ $row->id }}" class="btn btn-info" data-toggle="modal" data-target="#stockModal" onclick="updatequantity(this.id)">Update</button>
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

<!-- Modal -->
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Stock Quantity</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('update.stock.quantity') }}">
            @csrf
            <input type="hidden" name="product_id" id="product_id">
            <div class="form-group">
                <label for="exampleInputqty">Update the available quantity</label>
                <input type="number" name="product_quantity" id="quantity_num" class="form-control ml-2" min="1" value="1" style="width:80px;">
            </div>
            <button type="submit" class="btn btn-info">Update</button>
        </form> 
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



@endsection

@section('js')
    <script type="text/javascript">
        function updatequantity(id){

            $('#product_id').val(id);
            
        }
    </script>
@endsection