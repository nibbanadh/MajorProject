@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/preloader.css') }}">
@include('layouts.preloader')
@include('layouts.menubar')
@include('layouts.slider')

    <!-- Characteristics -->

    <div class="characteristics">
        <div class="container">
            <div class="row">

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_1.png')}}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_2.png')}}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_3.png')}}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_4.png')}}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deals of the week -->

    <div class="deals_featured">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
                    
                    <!-- Deals -->

                    <div class="deals">
                        <div class="deals_title">Deals of the Week</div>
                        <div class="deals_slider_container">
                            
                            <!-- Deals Slider -->
                            <div class="owl-carousel owl-theme deals_slider">
                                @foreach($hot as $ht)
                                    <!-- Deals Item -->
                                    <div class="owl-item deals_item">
                                        <div class="deals_image"><img src="{{ asset($ht->image_one)}}" alt=""></div>
                                        <div class="deals_content">
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <div class="deals_item_category"><a href="#">{{ $ht->brand_name }}</a></div>
                                                @if($ht->discount_price == NULL)
                                                @else
                                                    <div class="deals_item_price_a ml-auto">Rs.{{ $ht->selling_price }}</div>
                                                @endif
                                                
                                            </div>
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <a href="{{ url('product/details/'.$ht->id.'/'.$ht->product_name) }}"><div class="deals_item_name">{{ $ht->product_name }}</div></a>
                                                @if($ht->discount_price == NULL)
                                                    <div class="deals_item_price ml-auto">Rs.{{ $ht->selling_price }}</div>
                                                @else
                                                    <div class="deals_item_price ml-auto">Rs.{{ $ht->discount_price }}</div>
                                                @endif    
                                            </div>
                                            <div class="available">
                                                <div class="available_line d-flex flex-row justify-content-start">
                                                    <div class="available_title">Available: <span>{{ $ht->product_quantity }}</span></div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="deals_slider_nav_container">
                            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                        </div>
                    </div>
                    
                    <!-- Featured -->
                    <div class="featured">
                        <div class="tabbed_container">
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li class="active">Featured</li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="featured_slider slider">
                                    @foreach($featured as $row)
                                        <!-- Slider Item -->
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}"><div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($row->image_one)}}" alt="" style="height: 120px; width: 140px;"></div>
                                                <div class="product_content">
                                                    @if($row->discount_price == NULL)
                                                        <div class="product_price discount">Rs.{{ $row->selling_price }}</div>
                                                    @else
                                                        <div class="product_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                    @endif
                                                    
                                                    <div class="product_name"><div><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div></div>
                                                    <div class="product_extras">
                                                       
                                                        <button id="{{ $row->id }}" class="product_cart_button addCart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                                    </div>
                                                </div> 
                                                
                                                <a class="addWishlist" data-id="{{ $row->id }}">
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </a>
                                                <ul class="product_marks">
                                                    @if($row->discount_price == NULL)
                                                        <li class="product_mark product_discount" style="background: blue;">New</li>
                                                    @else
                                                        <li class="product_mark product_discount">
                                                            @php
                                                                $amount = intval($row->selling_price) - intval($row->discount_price);
                                                                $discount = $amount/intval($row->selling_price)*100;
                                                            @endphp

                                                            {{ intval($discount) }}%
                                                        </li>
                                                    @endif
                                                    
                                                    <li class="product_mark product_new">new</li>
                                                </ul>
                                            </div></a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->

    <div class="popular_categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                        <div class="popular_categories_link"><a href="#">full catalog</a></div>
                    </div>
                </div>
                
                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">
                            @foreach($catalog as $row)
                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="{{ asset('public/frontend/images/category1.png')}}" alt=""></div>
                                    <div class="popular_category_text">{{ $row->category_name }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner -->

    <div class="banner_2">
        <div class="banner_2_background" style="background-image:url({{ asset('public/frontend/images/banner_2_background.jpg')}})"></div>
        <div class="banner_2_container">
            <div class="banner_2_dots"></div>
            <!-- Banner 2 Slider -->

            <div class="owl-carousel owl-theme banner_2_slider">
                @foreach($mid as $row)

                    <!-- Banner 2 Slider Item -->
                    <div class="owl-item">
                        <div class="banner_2_item">
                            <div class="container fill_height">
                                <div class="row fill_height">
                                    <div class="col-lg-4 col-md-6 fill_height">
                                        <div class="banner_2_content">
                                            <div class="banner_2_category"><h4>{{ $row->category_name }}</h4></div>
                                            <div class="banner_2_title">{{ $row->product_name }}</div>
                                            <div class="banner_2_text"><h4>{{ $row->brand_name }}</h4></div><br>
                                            
                                            @if($row->discount_price == NULL)
                                                <h2>Rs.{{ $row->selling_price }}</h2>
                                            @else
                                                <h2>Rs.{{ $row->discount_price }}</h2>
                                            @endif
                                            
                                            <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="button banner_2_button"><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">Explore</a></div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-8 col-md-6 fill_height">
                                        <div class="banner_2_image_container">
                                            <div class="banner_2_image"><img src="{{ asset( $row->image_one )}}" alt="" style="height: 300px; width: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- category one -->
    @php 
        $cats = DB::table('categories')->skip(1)->first();
        $catid = $cats->id;

        $products = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)->orderBy('id','desc')->get();

    @endphp
    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $cats->category_name }}</div>
                            <ul class="clearfix">
                                <li class="active"></li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">

                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                <div class="featured_slider slider">
                                    @foreach($products as $row)
                                        <!-- Slider Item -->
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($row->image_one)}}" alt="" style="height: 120px; width: 140px;"></div>
                                                <div class="product_content">
                                                    @if($row->discount_price == NULL)
                                                        <div class="product_price discount">Rs.{{ $row->selling_price }}</div>
                                                    @else
                                                        <div class="product_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                    @endif
                                                    
                                                    <div class="product_name"><div><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div></div>
                                                    <div class="product_extras">
                                                        <div class="product_color">
                                                            <input type="radio" checked name="product_color" style="background:#b19c83">
                                                            <input type="radio" name="product_color" style="background:#000000">
                                                            <input type="radio" name="product_color" style="background:#999999">
                                                        </div>
                                                        <button id="{{ $row->id }}" class="product_cart_button addCart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                                    </div>
                                                </div> 
                                                
                                                <a class="addWishlist" data-id="{{ $row->id }}">
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </a>
                                                <ul class="product_marks">
                                                    @if($row->discount_price == NULL)
                                                        <li class="product_mark product_discount" style="background: blue;">New</li>
                                                    @else
                                                        <li class="product_mark product_discount">
                                                            @php
                                                                $amount = intval($row->selling_price) - intval($row->discount_price);
                                                                $discount = $amount/intval($row->selling_price)*100;
                                                            @endphp

                                                            {{ intval($discount) }}%
                                                        </li>
                                                    @endif
                                                    
                                                    <li class="product_mark product_new">new</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                            </div>

                        </div>
                                
                    </div>
                </div>
            </div>
        </div>      
    </div>

    <!-- category 2 -->

    @php 
        $cats = DB::table('categories')->skip(3)->first();
        $catid = $cats->id;

        $products = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)->orderBy('id','desc')->get();

    @endphp
    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $cats->category_name }}</div>
                            <ul class="clearfix">
                                <li class="active"></li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">

                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                <div class="featured_slider slider">
                                    @foreach($products as $row)
                                        <!-- Slider Item -->
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($row->image_one)}}" alt="" style="height: 120px; width: 140px;"></div>
                                                <div class="product_content">
                                                    @if($row->discount_price == NULL)
                                                        <div class="product_price discount">Rs.{{ $row->selling_price }}</div>
                                                    @else
                                                        <div class="product_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                    @endif
                                                    
                                                    <div class="product_name"><div><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div></div>
                                                    <div class="product_extras">
                                                        <div class="product_color">
                                                            <input type="radio" checked name="product_color" style="background:#b19c83">
                                                            <input type="radio" name="product_color" style="background:#000000">
                                                            <input type="radio" name="product_color" style="background:#999999">
                                                        </div>
                                                        <button id="{{ $row->id }}" class="product_cart_button addCart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                                    </div>
                                                </div> 
                                                
                                                <a class="addWishlist" data-id="{{ $row->id }}">
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </a>
                                                <ul class="product_marks">
                                                    @if($row->discount_price == NULL)
                                                        <li class="product_mark product_discount" style="background: blue;">New</li>
                                                    @else
                                                        <li class="product_mark product_discount">
                                                            @php
                                                                $amount = intval($row->selling_price) - intval($row->discount_price);
                                                                $discount = $amount/intval($row->selling_price)*100;
                                                            @endphp

                                                            {{ intval($discount) }}%
                                                        </li>
                                                    @endif
                                                    
                                                    <li class="product_mark product_new">new</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                            </div>

                        </div>
                                
                    </div>
                </div>
            </div>
        </div>      
    </div>

    <!-- Best Sellers -->

    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">Hot Best Sellers</div>
                            <ul class="clearfix">
                                <li class="active">Talets</li>
                                <li>Mobiles</li>
                                <li>Laptops & Computers</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <div class="bestsellers_panel panel active">

                            <!-- Best Sellers Slider -->

                            <div class="bestsellers_slider slider">
                                @foreach($tablets as $row)
                                    <!-- Best Sellers Item -->
                                    <div class="bestsellers_item discount">
                                        <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                            <div class="bestsellers_image"><img src="{{ asset($row->image_one)}}" alt=""></div>
                                            <div class="bestsellers_content">
                                                <div class="bestsellers_category"><a href="#">{{ $row->category_name }}</a></div>
                                                <div class="bestsellers_name"><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div>
                                                <div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                                @if($row->discount_price == NULL)
                                                    <div class="bestsellers_price discount">Rs.{{ $row->selling_price }}</div>
                                                @else
                                                    <div class="bestsellers_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                @endif
                                            </div>
                                        </div>
                                        <a class="addWishlist" data-id="{{ $row->id }}">
                                        <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                        </a>
                                        <ul class="bestsellers_marks">
                                            @if($row->discount_price == NULL)
                                                <li class="bestsellers_mark bestsellers_discount" style="background: blue;">New</li>
                                            @else
                                                <li class="bestsellers_mark bestsellers_discount">
                                                    @php
                                                        $amount = intval($row->selling_price) - intval($row->discount_price);
                                                        $discount = $amount/intval($row->selling_price)*100;
                                                    @endphp

                                                    {{ intval($discount) }}%
                                                </li>
                                            @endif
                                            <li class="bestsellers_mark bestsellers_new">new</li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bestsellers_panel panel">

                            <!-- Best Sellers Slider -->

                            <div class="bestsellers_slider slider">
                                @foreach($mobiles as $row)
                                    <!-- Best Sellers Item -->
                                    <div class="bestsellers_item discount">
                                        <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                            <div class="bestsellers_image"><img src="{{ asset($row->image_one)}}" alt=""></div>
                                            <div class="bestsellers_content">
                                                <div class="bestsellers_category"><a href="#">{{ $row->category_name }}</a></div>
                                                <div class="bestsellers_name"><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div>
                                                <div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                                @if($row->discount_price == NULL)
                                                    <div class="bestsellers_price discount">Rs.{{ $row->selling_price }}</div>
                                                @else
                                                    <div class="bestsellers_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                @endif
                                            </div>
                                        </div>
                                        <a class="addWishlist" data-id="{{ $row->id }}">
                                        <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                        </a>
                                        <ul class="bestsellers_marks">
                                            @if($row->discount_price == NULL)
                                                <li class="bestsellers_mark bestsellers_discount" style="background: blue;">New</li>
                                            @else
                                                <li class="bestsellers_mark bestsellers_discount">
                                                    @php
                                                        $amount = intval($row->selling_price) - intval($row->discount_price);
                                                        $discount = $amount/intval($row->selling_price)*100;
                                                    @endphp

                                                    {{ intval($discount) }}%
                                                </li>
                                            @endif
                                            <li class="bestsellers_mark bestsellers_new">new</li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bestsellers_panel panel">

                            <!-- Best Sellers Slider -->

                            <div class="bestsellers_slider slider">
                                @foreach($laptops as $row)
                                    <!-- Best Sellers Item -->
                                    <div class="bestsellers_item discount">
                                        <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                            <div class="bestsellers_image"><img src="{{ asset($row->image_one)}}" alt=""></div>
                                            <div class="bestsellers_content">
                                                <div class="bestsellers_category"><a href="#">{{ $row->category_name }}</a></div>
                                                <div class="bestsellers_name"><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div>
                                                <div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                                @if($row->discount_price == NULL)
                                                    <div class="bestsellers_price discount">Rs.{{ $row->selling_price }}</div>
                                                @else
                                                    <div class="bestsellers_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                @endif
                                            </div>
                                        </div>
                                        <a class="addWishlist" data-id="{{ $row->id }}">
                                        <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                        </a>
                                        <ul class="bestsellers_marks">
                                            @if($row->discount_price == NULL)
                                                <li class="bestsellers_mark bestsellers_discount" style="background: blue;">New</li>
                                            @else
                                                <li class="bestsellers_mark bestsellers_discount">
                                                    @php
                                                        $amount = intval($row->selling_price) - intval($row->discount_price);
                                                        $discount = $amount/intval($row->selling_price)*100;
                                                    @endphp

                                                    {{ intval($discount) }}%
                                                </li>
                                            @endif
                                            <li class="bestsellers_mark bestsellers_new">new</li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>



    <!-- Trends -->

    <div class="trends">
        <div class="trends_background" style="background-image:url({{ asset('public/frontend/images/trends_background.jpg')}})"></div>
        <div class="trends_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- Trends Content -->
                <div class="col-lg-3">
                    <div class="trends_container">
                        <h2 class="trends_title">Buy One Get One</h2>
                        <div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
                        <div class="trends_slider_nav">
                            <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Trends Slider -->

                @php 
                    $buyget = DB::table('products')
                        ->leftJoin('brands','products.brand_id','brands.id')
                        ->select('products.*','brands.brand_name')
                        ->where('products.status',1)
                        ->where('products.buyone_getone',1)->orderBy('products.id','desc')->limit(6)
                        ->get();
                @endphp
                <div class="col-lg-9">
                    <div class="trends_slider_container">

                        <!-- Trends Slider -->

                        <div class="owl-carousel owl-theme trends_slider">

                            <!-- Trends Slider Item -->
                            @foreach($buyget as $row)
                                <div class="owl-item">
                                    <div class="trends_item is_new">
                                        <div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset( $row->image_one )}}" alt=""></div>
                                        <div class="trends_content">
                                            <div class="trends_category"><a href="#">{{ $row->brand_name}}</a></div>
                                            <div class="trends_info clearfix">
                                                <div class="trends_name"><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name}}</a></div>
                                                @if($row->discount_price == NULL)
                                                    <div class="product_price discount">Rs.{{ $row->selling_price }}</div>
                                                @else
                                                    <div class="product_price discount">Rs.{{ $row->discount_price }}<span>Rs.{{ $row->selling_price }}</span></div>
                                                @endif
                                                <br>
                                                <button id="{{ $row->id }}" class="btn btn-primary btn-sm addCart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                                <!-- <a href="" class="btn btn-primary btn-sm">Add to Cart</a> -->
                                            </div>
                                        </div>
                                        <ul class="trends_marks">
                                            <li class="trends_mark trends_new">Free</li>
                                        </ul>
                                        <a class="addWishlist" data-id="{{ $row->id }}">
                                            <div class="trends_fav"><i class="fas fa-heart"></i></div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">
                        
                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach($brand_logos as $row)
                                <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset($row->brand_logo)}}" alt="" style="height:30px; width:70px;"></div></div>
                            @endforeach
                        </div>
                        
                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="{{ asset('public/frontend/images/send.png')}}" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text"><p></p></div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="{{ route('store.newslatter') }}" method="post" class="newsletter_form">
                                @csrf
                                <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address" name="email">
                                <button type="submit" class="newsletter_button">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLavel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLavel">Product Quick Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="" class="text-center" id="pimage" style="width:200px; height:220px;">
                                <div class="card-body">
                                    <h5 class="card-title text-center" id="pname"></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Code: <span id="pcode"></span></li>
                                <li class="list-group-item">Catalog: <span id="pcatalog"></span></li>
                                <li class="list-group-item">Category: <span id="pcategory"></span></li>
                                <li class="list-group-item" id="subcat">Subcategory: <span id="psubcategory"></span></li>
                                <li class="list-group-item" id="brand">Brand: <span id="pbrand"></span></li>
                                <li class="list-group-item">Available Quantity: <span id="pstock" ></span> <span id="punit" ></span></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <form method="post" action="{{ route('insert.into.cart') }}">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id">
                                <div class="form-group">
                                    <label for="exampleInputcolor">Color</label>
                                    <select class="form-control" name="color" id="color">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputsize">Size</label>
                                    <select class="form-control" name="size" id="size">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputqty">Quantity</label>
                                    <input type="number" id="quantity_num" class="form-control ml-2" name="qty" min="" max="" value="" style="width:80px;">
                                </div>
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>












    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('public/frontend/js/custom.js')}}"></script>
    
    <script type="text/javascript">
        function productview(id){
            $.ajax({
                url: "{{ url('/cart/product/view') }}/" + id,
                type: "GET",
                dataType: "json",
                success:function(data){
                    $('#product_id').val(data.product.id);
                    $('#pname').text(data.product.product_name);
                    $('#pimage').attr('src',data.product.image_one);
                    $('#pcode').text(data.product.product_code);
                    $('#pcatalog').text(data.product.category_name);
                    $('#pcategory').text(data.product.subcategory_name);
                    $('#pstock').text(data.product.product_quantity);
                    $('#punit').text(data.product.unit);
                    $('#quantity_num').val(data.product.buying_limit);
                    $('#quantity_num').attr('max',data.product.product_quantity);
                    $('#quantity_num').attr('min',data.product.buying_limit);
                    if(data.product.minicategory_name)
                    {
                        $('#subcat').show();
                        $('#psubcategory').text(data.product.minicategory_name);
                    }else{
                        $('#subcat').hide();
                    }
                    
                    if(data.product.brand_name)
                    {
                        $('#brand').show();
                        $('#pbrand').text(data.product.brand_name);
                    }else{
                        $('#brand').hide();
                    }

                    var d = $('select[name="color"]').empty();
                    $.each(data.color, function(key, value){
                        $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>');
                    });

                    var d = $('select[name="size"]').empty();
                    $.each(data.size, function(key, value){
                        $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
                    });
                },
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            // for wishlist ajax
            $('.addWishlist').on('click', function(){
                var id = $(this).data('id');
                if(id)
                {
                    $.ajax({
                        url: " {{ url('add/wishlist/') }}/"+id,
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            if($.isEmptyObject(data.error)){
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }
                            
                        },
                    });
                }else{
                    console.log('ajax error');
                }
            });
        });
    </script>
@endsection