@extends('admin.admin_layouts')


@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Email
            </h6>

            <p class="mg-b-20 mg-sm-b-30">Emailing Form</p>

            <form method="post" action="{{route('email.subscriber.success')}}" enctype="multipart/form-data">
                @csrf


                <div class="form-layout">
                    <div class="row mg-b-25">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Send To: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email_to" value="{{$emails}}" id="email_to" data-role="tagsinput" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Subject: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email_subject" placeholder="Subject" required>
                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Email Detail (Type Plain Text or Embbed HTML Code): <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="email_body" required>
                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                    </div>

                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Email All</button>
                        <a href="{{ route('all.product') }}" class="btn btn-secondary">Cancel</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div><!-- row -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection