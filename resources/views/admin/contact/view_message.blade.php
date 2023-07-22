@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Contact Message Details</strong> </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name: </th>
                                    <th>{{ $message->name }}</th>
                                </tr>
                                <tr>
                                    <th>Phone: </th>
                                    <th>{{ $message->phone }}</th>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <th>{{ $message->email }}</th>
                                </tr>
                                <tr>
                                    <th>Message: </th>
                                    <th>{{ $message->message }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

        </div><!-- card -->

      </div><!-- sl-pagebody -->
      
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->



@endsection