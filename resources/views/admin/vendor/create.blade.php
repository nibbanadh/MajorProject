@extends('admin.admin_layouts')


@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Add New Vendor
                <a href=" {{route('all.vendor')}}" class="btn btn-success btn-sm pull-right"> All Vendor </a>
            </h6>


            <form method="post" action="{{route('store.vendor')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-layout">
                    <div class="row mg-b-25">
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company Name: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('company_name') is-invalid @enderror" type="text" name="company_name" required>

                                @error('company_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Owner Name: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required>

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Phone Number" required>

                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="user@gmail.com" required>

                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" required>

                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Vendor Details: <span class="tx-danger">*</span></label>
                                <textarea class="form-control @error('company_details') is-invalid @enderror" id="summernote" name="company_details" required>
                                </textarea>

                                @error('company_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->

                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Add</button>
                        <a href="{{ route('all.vendor') }}" class="btn btn-secondary">Cancel</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div><!-- row -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection

@section('js')

@endsection