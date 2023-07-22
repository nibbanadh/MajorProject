@extends('admin.admin_layouts')


@section('admin_content')

@php
    $category = DB::table('categories')->get();
    $brand = DB::table('brands')->get();
    $subcategory = DB::table('subcategories')->get();
    $minicategory = DB::table('minicategories')->get();
@endphp

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">OnNepa</a>
        <span class="breadcrumb-item active">Product Section</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Product
                <a href=" {{route('all.product')}}" class="btn btn-success btn-sm pull-right"> All product </a>
            </h6>

            <p class="mg-b-20 mg-sm-b-30">Update Product Form</p>

            <form method="post" action="{{ url('update/product/withoutimage/'.$product->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name" value="{{$product->product_name}}" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code" value="{{$product->product_code}}" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Packaging Size: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" min="1" name="product_quantity" value="{{$product->product_quantity}}" required>
                            </div>
                        </div><!-- col-2 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Unit: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="" name="unit" required>
                                    <option label="Choose unit"></option>
                                    <option value="gross" <?php if($product->unit == 'gross'){ echo "selected"; } ?> >Gross</option>
                                    <option value="box" <?php if($product->unit == 'box'){ echo "selected"; } ?> >Box</option>
                                    <option value="cartoon" <?php if($product->unit == 'cartoon'){ echo "selected"; } ?> >Cartoon</option>
                                    <option value="dozen" <?php if($product->unit == 'dozen'){ echo "selected"; } ?> >Dozen</option>
                                    <option value="pics" <?php if($product->unit == 'pics'){ echo "selected"; } ?> >Pics</option>
                                    <option value="kg" <?php if($product->unit == 'kg'){ echo "selected"; } ?> >kg</option>
                                    <option value="roll" <?php if($product->unit == 'roll'){ echo "selected"; } ?> >Roll</option>
                                </select>
                            </div>
                        </div><!-- col-2 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Buying Quantity Limitation: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" min="1" name="buying_limit" value="{{$product->buying_limit}}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Discounted Price: </label>
                                <input class="form-control" type="number" name="discount_price" value="{{$product->discount_price}}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Catalog: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="" name="category_id" required>
                                    <option label="Choose Catalog"></option>
                                    @foreach($category as $row)
                                    <option value="{{ $row->id }}" <?php if($row->id == $product->category_id){ echo "selected"; } ?> >{{ $row->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="subcategory_id" required>
                                   
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Sub-Category: </label>
                                <select class="form-control select2" name="minicategory_id">
                                   
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand:</label>
                                <select class="form-control selectpicker" data-live-search="true" name="brand_id">
                                    @foreach($brand as $br)
                                    <option value="{{ $br->id }}" <?php if($br->id == $product->brand_id){ echo "selected"; } ?> >{{ $br->brand_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Vendor List: <span class="tx-danger">*</span></label>
                                <select class="form-control selectpicker" data-placeholder="" name="vendor" data-live-search="true" required>
                                    @foreach($vendor as $row)
                                        <option value="{{ $row->company_name }}" <?php if($product->vendor == $row->company_name){ echo "selected"; } ?> >{{ $row->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size:</label>
                                <input class="form-control" type="text" name="product_size" value="{{ $product->product_size }}" id="size" data-role="tagsinput" >
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_color" value="{{ $product->product_color }}" id="color"
                                data-role="tagsinput" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" name="selling_price" value="{{ $product->selling_price }}" required>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="product_details" required>
                                    {{ $product->product_details }}
                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video Link:</label>
                                <input class="form-control" name="video_link" value="{{ $product->video_link }}">
                            </div>
                        </div><!-- col-4 -->

                    </div><!-- row -->


                    <hr>
                    <br><br>

                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="main_slider" value="1" <?php if($product->main_slider == 1){echo "checked";} ?> >
                                <span>Main Slider</span>
                            </label>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="hot_deal" value="1" <?php if($product->hot_deal == 1){echo "checked";} ?> >
                                <span>Hot Deal</span>
                            </label>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="best_rated" value="1" <?php if($product->best_rated == 1){echo "checked";} ?> >
                                <span>Best Rated</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="trend_product" value="1" <?php if($product->trend_product == 1){echo "checked";} ?> >
                                <span>Trend Product</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="mid_slider" value="1" <?php if($product->mid_slider == 1){echo "checked";} ?> >
                                <span>Mid Slider</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="hot_new" value="1" <?php if($product->hot_new == 1){echo "checked";} ?> >
                                <span>Hot New</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="buyone_getone" value="1" <?php if($product->buyone_getone == 1){echo "checked";} ?> >
                                <span>Buyone Getone</span>
                            </label>

                        </div><!-- col-4 -->

                        <br><br>

                    </div>
                    <!--end row-->

                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">Update Product</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div><!-- row -->

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Product Images</h6>
            <form method="post" action="{{ url('update/product/image/'.$product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label class="form-control-label">Image One (Main Thumbnail): <span
                                class="tx-danger">*</span></label><br>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_one"
                                onchange="readURL(this);">
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="old_one" value="{{ $product->image_one }}">
                            <img src="#" id="one">
                        </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{ URL::to($product->image_one) }}" style="width:80px; height:80px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label><br>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_two"
                                onchange="readURL2(this);">
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="old_two" value="{{ $product->image_two }}">
                            <img src="#" id="two">
                        </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{ URL::to($product->image_two) }}" style="width:80px; height:80px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label><br>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_three"
                                onchange="readURL3(this);">
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="old_three" value="{{ $product->image_three }}">
                            <img src="#" id="three">
                        </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{ URL::to($product->image_three) }}" style="width:80px; height:80px;">
                    </div>
                </div><br>
                <button type="submit" class="btn btn-sm btn-info">Update Image</button>
            </form>
        </div>
    </div>        

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        // for default selected catelog
        const def_category_id = <?php echo $product->category_id ?>;
        const def_subcategory_id = <?php echo $product->subcategory_id ?>;
        if(def_category_id) {
            $.ajax({
                url: "{{ url('/get/subcategory/') }}/" + def_category_id,
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
                    $('select[name="subcategory_id"]').val(def_subcategory_id);
                },
            });
        }

        // for onchange catelog
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

        // for default category
        <?php if($product->minicategory_id == null){ ?>
            const def_minicategory_id = null;
        <?php }else{ ?>
            const def_minicategory_id = <?php echo $product->minicategory_id ?>;
        <?php } ?>
        
        if(def_subcategory_id) {
            $.ajax({
                url: "{{ url('/get/minicategory/') }}/" + def_subcategory_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var d = $('select[name="minicategory_id"]').empty();
                    
                    $.each(data, function(key, value) {

                        $('select[name="minicategory_id"]').append(
                            '<option value="' + value.id + '">' + value
                            .minicategory_name + '</option>');

                    });
                    $('select[name="minicategory_id"]').val(def_minicategory_id);
                },
            });
        }

        // for onchange category
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