@extends('admin.admin_layouts')


@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Vendor Details
                <a href=" {{route('all.vendor')}}" class="btn btn-success btn-sm pull-right"> All Vendor </a>
            </h6><br>
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Company Name:</label><br>
                            <strong>{{$vendor->company_name}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Owner Name:</label><br>
                            <strong>{{$vendor->name}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Phone:</label><br>
                            <strong>{{$vendor->phone}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Email:</label><br>
                            <strong>{{$vendor->email}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Address:</label><br>
                            <strong>{{$vendor->address}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-12">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Vendor Details:</label><br>
                            <strong>{!! $vendor->company_details !!}</strong>
                        </div>
                    </div><!-- col-4 -->

                   
            </div><!-- form-layout -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection
