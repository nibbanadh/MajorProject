@extends('admin.admin_layouts')


@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">OnNepa</a>
        <span class="breadcrumb-item active">Website Setting</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Site Setting</h6>


            <form method="post" action="{{ route('update.sitesetting') }} " enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$setting->id}}">
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone One: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_one" value="{{$setting->phone_one}}" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone Two: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_two" value="{{$setting->phone_two}}" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{$setting->email}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name" value="{{$setting->company_name}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Company Address: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="company_address" value="{{$setting->company_address}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">VAT(%): <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" min="0" name="vat" value="{{$setting->vat}}" required>
                            </div>
                        </div><!-- col-2 -->

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Delivery Charge: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" min="0" name="shipping_charge" value="{{$setting->shipping_charge}}" required>
                            </div>
                        </div><!-- col-2 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Tagline: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="tagline" value="{{$setting->tagline}}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Facebook: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="facebook" value="{{$setting->facebook}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Youtube : <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="youtube" value="{{$setting->youtube}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Instagram : <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="instagram" value="{{$setting->instagram}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Twitter : <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="twitter" value="{{$setting->twitter}}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="row">
                                <div class="form-group col-8">
                                    <label class="form-control-label">Company Logo:</label>
                                    <input class="form-control" type="file" name="logo" value="{{$setting->logo}}" onchange="readURL(this)">
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset($setting->logo) }}" id="logo" alt="" style="width:100px">
                                </div>
                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->


                    <hr>


                </div>
                <!--end row-->

                <br><br>
                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">Update</button>
                </div><!-- form-layout-footer -->
        </div><!-- form-layout -->
    </div><!-- card -->
    </form>
</div><!-- row -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo')
                    .attr('src', e.target.result)
                    .width(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection