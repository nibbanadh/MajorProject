@extends('admin.admin_layouts')


@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">


    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Seo Setting</h6>

            <form method="post" action="{{route('update.seo')}}" >
                @csrf

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Title: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_title" <?php if(!empty($seo))echo "value='$seo->meta_title'" ?>>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Author: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_author" <?php if(!empty($seo))echo "value='$seo->meta_author'" ?>>
                            </div>
                        </div><!-- col-6 -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tag: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="meta_tag" name="meta_tag"  <?php if(!empty($seo))echo "value='$seo->meta_tag'" ?> data-role="tagsinput">
                            </div>
                        </div><!-- col-6 -->

                        

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Meta Description: <span class="tx-danger">*</span></label>
                                <textarea class="form-control"  name="meta_description" required>
                                    <?php if(!empty($seo))echo "$seo->meta_description" ?>
                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Google Analytics: <span class="tx-danger">*</span></label>
                                <textarea class="form-control"  name="google_analytics" required>
                                    <?php if(!empty($seo))echo "$seo->google_analytics" ?>
                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Bing Analytics: <span class="tx-danger">*</span></label>
                                <textarea class="form-control"  name="bing_analytics" required>
                                    <?php if(!empty($seo))echo "$seo->bing_analytics" ?>
                                </textarea>
                                <input type="hidden" name="id"<?php if(!empty($seo))echo "value='$seo->id'" ?>>
                            </div>
                        </div><!-- col-4 -->


                        


                        
                        
                    </div><!-- row -->

                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Update</button>
                        <a href="{{ route('all.blogpost') }}" class="btn btn-secondary">Cancel</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div><!-- row -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection

@section('js')
<script type="text/javascript">
    
    function readURL(input) {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#one')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection