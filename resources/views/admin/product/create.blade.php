@extends('admin.admin_layouts')


@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Product Add
                <a href=" {{route('all.product')}}" class="btn btn-success btn-sm pull-right"> All product </a>
            </h6>

            <p class="mg-b-20 mg-sm-b-30">New Product Add Form</p>

            <form method="post" action="{{route('store.product')}}" enctype="multipart/form-data">
                @csrf


                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name" placeholder="Product Name" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code" placeholder="Product Code" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Packaging Size: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" min="1" name="product_quantity" value="1"
                                    placeholder="Packaging Size" required>
                            </div>
                        </div><!-- col-2 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Unit: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="" name="unit" required>
                                    <option label="Choose unit"></option>
                                    <option value="gross">Gross</option>
                                    <option value="box">Box</option>
                                    <option value="cartoon">Cartoon</option>
                                    <option value="dozen">Dozen</option>
                                    <option value="pics">Pics</option>
                                    <option value="kg">kg</option>
                                    <option value="roll">Roll</option>
                                </select>
                            </div>
                        </div><!-- col-2 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Buying Quantity Limitation: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" min="1" name="buying_limit" value="1" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Discounted Price:</label>
                                <input class="form-control" type="number" name="discount_price"
                                    placeholder="Discounted Price">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Catalog: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="" name="category_id" required>
                                    <option label="Choose Catalog"></option>
                                    @foreach($category as $row)
                                    <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="" name="subcategory_id" required>
                                    
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Sub-Category: </label>
                                <select class="form-control select2" data-placeholder=""
                                    name="minicategory_id">
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand:</label>
                                <select class="form-control selectpicker" data-live-search="true" name="brand_id">
                                    <option></option>
                                    @foreach($brand as $br)
                                    <option value="{{ $br->id }}">{{ $br->brand_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Vendor List: <span class="tx-danger">*</span></label>
                                <select class="form-control selectpicker" name="vendor" data-live-search="true" required>
                                    <option></option>
                                    @foreach($vendor as $row)
                                        <option value="{{ $row->company_name }}">{{ $row->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size:</label>
                                <input class="form-control" type="text" name="product_size" value="" id="size"
                                    data-role="tagsinput">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_color" value="" id="color"
                                    data-role="tagsinput" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" name="selling_price" placeholder="Selling Price" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="product_details" required>
                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video Link: </label>
                                <input class="form-control" name="video_link" placeholder="Video Link">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image One (Main Thumbnail): <span
                                        class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_one"
                                        onchange="readURL(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="one">
                                </label>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_two"
                                        onchange="readURL2(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="two">
                                </label>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_three"
                                        onchange="readURL3(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="three">
                                </label>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->


                    <hr>
                    <br><br>

                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="main_slider" value="1">
                                <span>Main Slider</span>
                            </label>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="hot_deal" value="1">
                                <span>Hot Deal</span>
                            </label>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="best_rated" value="1">
                                <span>Best Rated</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="trend_product" value="1">
                                <span>Trend Product</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="mid_slider" value="1">
                                <span>Mid Slider</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="hot_new" value="1">
                                <span>Hot New</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="buyone_getone" value="1">
                                <span>Buyone Getone</span>
                            </label>

                        </div><!-- col-4 -->

                        <br><br>


                    </div>
                    <!--end row-->

                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Add</button>
                        <a href="{{ route('all.product') }}" class="btn btn-secondary">Cancel</a>
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
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {

                $.ajax({
                    url: "{{ url('/get/subcategory/') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $('select[name="subcategory_id"]').append('<option label="Choose Category"></option>');
                        $.each(data, function(key, value) {

                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name + '</option>');

                        });
                    },
                });

            } else {
                $('select[name="subcategory_id"]').empty();
                $('select[name="minicategory_id"]').empty();
            }

        });

        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $(this).val();
            var category_id = $('select[name="category_id"]').val();
            if (category_id && subcategory_id) {

                $.ajax({
                    url: "{{ url('/get/minicategory/') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="minicategory_id"]').empty();
                        
                        $.each(data, function(key, value) {

                            $('select[name="minicategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .minicategory_name + '</option>');

                        });
                    },
                });

            } else {
                $('select[name="minicategory_id"]').empty();
            }

        });
    });

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

    function readURL2(input) {
        if(input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#two')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL3(input) {
        if(input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#three')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection