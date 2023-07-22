@extends('admin.admin_layouts')


@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product Details
                <a href=" {{route('all.product')}}" class="btn btn-success btn-sm pull-right"> All product </a>
            </h6><br>
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Name:</label><br>
                            <strong>{{$product->product_name}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Code:</label><br>
                            <strong>{{$product->product_code}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Packaging Size:</label><br>
                            <strong>{{$product->product_quantity}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Unit:</label><br>
                            <strong>{{$product->unit}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Buying Quantity Limitation:</label><br>
                            <strong>{{$product->buying_limit}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Discounted Price:</label><br>
                            <strong>{{$product->discount_price}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Catalog:</label><br>
                            <strong>{{$product->category_name}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Category:</label><br>
                            <strong>{{$product->subcategory_name}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Sub-Category: </label><br>
                            <strong>{{$product->minicategory_name}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Brand:</label><br>
                            <strong>{{$product->brand_name}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Vendor:</label><br>
                            <strong>{{$product->vendor}}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Size:</label><br>
                            <strong>{{$product->product_size}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Color:</label>
                            <br>
                            <strong>{{$product->product_color}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Selling Price:</label>
                            <br>
                            <strong>{{$product->selling_price}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Product Details:</label><br>
                            <p>{!! $product->product_details !!}</p>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Video Link:</label><br>
                            <strong>{{$product->video_link}}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image One (Main Thumbnail):</label><br>
                            <label class="custom-file">
                                <img src="{{ URL::to($product->image_one) }}" style="height: 80px; width: 80px;">
                            </label>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Two:</label><br>
                            <label class="custom-file">
                                <img src="{{ URL::to($product->image_two) }}" style="height: 80px; width: 80px;">
                            </label>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Three:</label><br>
                            <label class="custom-file">
                                <img src="{{ URL::to($product->image_three) }}" style="height: 80px; width: 80px;">
                            </label>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->


                <hr>
                <br><br>

                <div class="row">
                    <div class="col-lg-4">
                        <label class="">
                            @if($product->main_slider == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Main Slider</span>
                        </label>
                    </div><!-- col-4 -->


                    <div class="col-lg-4">
                        <label class="">
                            @if($product->hot_deal == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Hot Deal</span>
                        </label>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            @if($product->best_rated == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Best Rated</span>
                        </label>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            @if($product->trend_product == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Trend Product</span>
                        </label>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            @if($product->mid_slider == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Mid Slider</span>
                        </label>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            @if($product->hot_new == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Hot New</span>
                        </label>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <label class="">
                            @if($product->buyone_getone == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            <span>Buyone Getone</span>
                        </label>
                    </div><!-- col-4 -->

                </div>
                <!--end row-->
            </div><!-- form-layout -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection
