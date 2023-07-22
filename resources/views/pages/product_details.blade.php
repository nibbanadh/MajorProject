<title>{{setting('company_name')}}<?php echo !empty($title) ? " | ".$title : ""; ?></title>

<!-- Primary Meta Tags -->
<meta name="title" content="<?php echo !empty($meta_title) ? $meta_title : seo('meta_title'); ?>">
<meta name="description" content="<?php echo !empty($meta_desc) ? $meta_desc : seo('meta_description'); ?>">
<meta name="keywords" content="{{ seo('meta_tag') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="product">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="<?php echo !empty($meta_title) ? $meta_title : seo('meta_title'); ?>">
<meta property="og:description" content="<?php echo !empty($meta_desc) ? $meta_desc : seo('meta_description'); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ Request::url() }}">
<meta property="twitter:title" content="<?php echo !empty($meta_title) ? $meta_title : seo('meta_title'); ?>">
<meta property="twitter:description" content="<?php echo !empty($meta_desc) ? $meta_desc : seo('meta_description'); ?>">

<!-- meta image -->
@if(!empty($meta_image))
    <meta property="og:image" content="{{ asset($meta_image) }}">
    <meta property="twitter:image" content="{{ asset($meta_image) }}">
@else
    <meta property="og:image" content="{{ asset('public/media/meta-image.png') }}">
    <meta property="twitter:image" content="{{ asset('public/media/meta-image.png') }}">
@endif
<!-- favicon -->
<link rel="icon" href="{{  asset(setting('logo')) }}" type="image/gif" sizes="16x16">

@extends('layouts.app')

@section('content')

@include('layouts.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/product_responsive.css') }}">

    <!-- Single Product -->

	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						<li data-image="{{ asset( $product->image_one ) }}"><img src="{{ asset( $product->image_one ) }}" alt=""></li>
						<li data-image="{{ asset( $product->image_two ) }}"><img src="{{ asset( $product->image_two ) }}" alt=""></li>
						<li data-image="{{ asset( $product->image_three ) }}"><img src="{{ asset( $product->image_three ) }}" alt=""></li>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{ asset( $product->image_one ) }}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
                        @if($product->minicategory_name != NULL)
                            <div class="product_category">{{ $product->category_name }} > {{ $product->subcategory_name }} > {{ $product->minicategory_name }}</div>
                        @else
                            <div class="product_category">{{ $product->category_name }} > {{ $product->subcategory_name }}</div>
                        @endif
						
						<div class="product_name">{{ $product->product_name }}</div>
						<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
						<div class="product_text"><p>{!! str_limit($product->product_details, $limit = 500 ) !!}</p></div><br><br>
                        <p>Available Quantity: {{ $product->product_quantity}} {{ $product->unit }}</p>
						<div class="order_info d-flex flex-row">
							<form action="{{ url('cart/product/add/'.$product->id) }}" method="post">
                                @csrf
								<div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <select class="form-control input-lg" id="color" name="color" style="width:100%!important;">
                                                @foreach($product_color as $color)
                                                    <option value="{{ $color }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($product->product_size != null)
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="size">Size</label>
                                                <select class="form-control input-lg" id="size" name="size">
                                                    @foreach($product_size as $size)
                                                        <option value="{{ $size }}">{{ $size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="number" class="form-control" value="{{ $product->buying_limit }}" min="{{ $product->buying_limit }}" max="{{ $product->product_quantity }}" name="qty">
                                        </div>
                                    </div>

                                </div>
                                
                                @if($product->discount_price == NULL)
                                    <div class="product_price">Rs.{{ $product->selling_price }}</div><span> /per {{ $product->unit }}</span>
                                @else
                                    <div class="product_price">Rs.{{ $product->discount_price }}<span>Rs.{{ $product->selling_price }} /per {{ $product->unit }}</span> </div>
                                @endif
								
								<div class="button_container">
									<button type="submit" class="button cart_button">Add to Cart</button>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
								</div>
                                <br>
                                <div class="button-container">
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_toolbox addthis_default_style addthis_16x16_style">
                                        <a class="addthis_button_facebook"></a>
                                        <a class="addthis_button_twitter"></a>
                                        <a class="addthis_button_linkedin"></a>
                                    </div>
                                </div>
								
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Product Details</h3>
					</div>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Product Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Videos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Product Review</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
                            {!! $product->product_details !!}
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                            <iframe width="540" height="295" src="{{ $product->video_link }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5"></div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    
@endsection
    <div id="fb-root"></div>
@section('js')
    <script src="{{ asset('public/frontend/js/custom.js')}}"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="p8OMMhpv"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6071420d3cee0973"></script>
    <!-- <script src="{{ asset('public/frontend/js/product_custom.js')}}"></script> -->
@endsection
    