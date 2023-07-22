@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Vendor List</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">List All Vendor
                <a href="{{ route('add.vendor' )}}" class="btn btn-sm btn-success" style="float:right;">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table scrollable display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Company Name</th>
                        <th class="wd-15p">Owner Name</th>
                        <th class="wd-15p">Phone </th>
                        <th class="wd-20p">Email</th>
                        <th class="wd-20p">Address</th>
                        <th class="wd-20p">Details</th>
                        <th class="wd-20p">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($vendors as $row)
                      <tr>
                        <td>{{ $row->company_name }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{!! Str::limit($row->company_details, 10) !!}</td>

                        <td>
                          <a href="{{ URL::to('admin/edit/vendor/'.$row->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i>
                          </a>

                          <a href="{{ URL::to('admin/view/vendor/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>

                          <a href="{{ URL::to('admin/delete/vendor/'.$row->id) }}" class="btn btn-sm btn-danger" title="Delete" id="delete"><i class="fa fa-trash"></i></a>

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