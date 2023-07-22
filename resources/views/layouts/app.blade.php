<!DOCTYPE html>
<html lang="en">
<head>

@if(empty($meta_title))
<title>{{setting('company_name')}}<?php echo !empty($title) ? " | ".$title : ""; ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Primary Meta Tags -->
<meta name="title" content="<?php echo !empty($meta_title) ? $meta_title : seo('meta_title'); ?>">
<meta name="description" content="<?php echo !empty($meta_desc) ? $meta_desc : seo('meta_description'); ?>">
<meta name="keywords" content="{{ seo('meta_tag') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="product">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:title" content="<?php echo !empty($meta_title) ? $meta_title : seo('meta_title'); ?>">
<meta property="og:description" content="<?php echo !empty($meta_desc) ? $meta_desc : seo('meta_description'); ?>">
<meta property="og:image" content="{{ asset('public/media/meta-image.png') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ Request::url() }}">
<meta property="twitter:title" content="<?php echo !empty($meta_title) ? $meta_title : seo('meta_title'); ?>">
<meta property="twitter:description" content="<?php echo !empty($meta_desc) ? $meta_desc : seo('meta_description'); ?>">
<meta property="twitter:image" content="{{ asset('public/media/meta-image.png') }}">

<!-- favicon -->
<link rel="icon" href="{{  asset(setting('logo')) }}" type="image/gif" sizes="16x16">
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/slick-1.8.0/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/responsive.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://js.stripe.com/v3/"></script>
</head>

<body>

<div class="super_container">
    
    <!-- Header -->
    
    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend/images/phone.png')}}" alt=""></div>{{ setting('phone_one') }}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend/images/mail.png')}}" alt=""></div><a href="mailto:{{ setting('email') }}">{{ setting('email') }}</a></div>
                        <div class="top_bar_content ml-auto">
                            @guest

                            @else
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="" data-toggle="modal" data-target="#exampleModal">Track Order</a>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                            @php
                            if(\Request::is('blog/post') || \Request::is('blog/single/*')){
                            @endphp
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown">
                                    @php 
                                        $language = Session()->get('lang');
                                    @endphp
                                    <li>
                                        @if($language == 'nepali')
                                            <a href="{{ route('language.english') }}">English<i class="fas fa-chevron-down"></i></a>
                                        @else
                                            <a href="{{ route('language.nepali') }}">Nepali<i class="fas fa-chevron-down"></i></a>
                                        @endif
                                        
                                    </li>
                                </ul>
                            </div>
                            @php
                            } 
                            @endphp
                            <div class="top_bar_user">
                                @guest 
                                    <div><a href="{{ route('login') }}"><div class="user_icon"><img src="{{ asset('public/frontend/images/user.svg')}}" alt=""></div> Register/Login</a></div>
                                @else
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="{{ route('home') }}"><div class="user_icon">
                                                @if(!empty(Auth::user()->avatar))
                                                    <img src="{{ asset(Auth::user()->avatar) }}" style="border-radius:50%">
                                                @else
                                                    <img src="{{ asset('public/frontend/images/avatar_profile.png') }}" style="border-radius:50%">
                                                @endif
                                                </div>{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i>
                                            </a>
                                            <ul>
                                                <li><a href="{{ route('user.wishlist') }}">Wishlist</a></li>
                                                <li><a href="{{ route('user.checkout') }}">Checkout</a></li>
                                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>

        <!-- Header Main -->

        <div class="header_main">
            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="col-lg-2 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo"><a href="{{ route('front.index') }}">{{setting('company_name')}}</a></div>
                        </div>
                    </div>
                    @php
                        $catalog = DB::table('categories')->get();
                    @endphp
                    <!-- Search -->
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                   
                                    <form method="post" action="{{ route('product.search') }}" class="header_search_form clearfix">
                                        @csrf
                                        <input type="search" required="required" class="header_search_input" placeholder="Search for products..." name="search" style="width:100%;">
                                        <div class="custom_dropdown" style="display:none;">
                                            <div class="custom_dropdown_list">
                                                <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                <i class="fas fa-chevron-down"></i>
                                                <ul class="custom_list clc">
                                                    @foreach($catalog as $cata)
                                                        <li><a class="clc" href="#">{{ $cata->category_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('public/frontend/images/search.png')}}" alt=""></button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                @guest

                                @else
                                    @php 
                                        $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->get();
                                    @endphp
                                    <div class="wishlist_icon"><img src="{{ asset('public/frontend/images/heart.png')}}" alt=""></div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a href="{{ route('user.wishlist') }}">Wishlist</a></div>
                                        <div class="wishlist_count">{{ count($wishlist) }}</div>
                                    </div>
                            
                                @endguest
                            </div>
                            <!-- Cart -->
                            <div class="cart">
                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                    <div class="cart_icon">
                                        <img src="{{ asset('public/frontend/images/cart.png') }}" alt="">
                                        <div class="cart_count"><span>{{ Cart::count() }}</span></div>
                                    </div>
                                    <div class="cart_content">
                                        <div class="cart_text"><a href="{{ route('show.cart') }}">Cart</a></div>
                                        <div class="cart_price">Rs. {{ Cart::subtotal() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

    @yield('content')
    

    <!-- Footer -->

  

    <footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 footer_col">
                    <div class="footer_column footer_contact">
                        <div class="logo_container">
                            <div class="logo"><a href="{{ route('front.index') }}">{{ setting('company_name') }}</a></div>
                        </div>
                        <div class="footer_title">Got Question? Call Us 24/7</div>
                        <div class="footer_phone">{{ setting('phone_two')}}</div>
                        <div class="footer_contact_text">
                            <p>{{ setting('company_address')}}</p>
                            
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="{{ setting('facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ setting('youtube') }}"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="{{ setting('instagram') }}"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ setting('twitter') }}"><i class="fab fa-twitter"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 offset-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Find it Fast</div>
                        <ul class="footer_list">
                            <li><a href="{{ url('allsubcategory/35') }}">Computers & Laptops</a></li>
                            <li><a href="{{ url('allsubcategory/24') }}">Audio</a></li>
                            <li><a href="{{ url('allsubcategory/10') }}">Gents Watch</a></li>
                            <li><a href="{{ route('blog.post') }}">Blog</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Customer Care</div>
                        <ul class="footer_list">
                            <li><a href="{{ url('/home') }}">My Account</a></li>
                            <li><a href="{{ route('show.cart') }}">Cart List</a></li>
                            <li><a href="{{ route('user.wishlist') }}">Wish List</a></li>
                            <li><a href="{{ route('contact.page') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Copyright -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    
                    <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                        <div class="copyright_content">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
</div>
                        <div class="logos ml-sm-auto">
                            <ul class="logos_list">
                                <!-- <li><a href="#"><img src="{{ asset('public/frontend/images/logos_1.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('public/frontend/images/logos_2.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('public/frontend/images/logos_3.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('public/frontend/images/logos_4.png')}}" alt=""></a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Order tarcking Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Track with Status Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('order.tracking') }}">
        @csrf 
        <div class="modal-body">
            <label>Status Code</label>
            <input type="text" name="code" required="" class="form-control" placeholder="Your Order Status Code"><br>
            <button class="btn btn-danger" type="submit">Track Now</button>
        </div>
      </form>
    </div>
  </div>
</div>




<script src="{{ asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{ asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{ asset('public/frontend/plugins/easing/easing.js')}}"></script>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type)
        {
            case 'info':
            toastr.info(" {{ Session::get('message')}} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message')}} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message')}} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message')}} ");
            break;
        }
    @endif
</script>

<script>  
    $(document).on("click", "#return", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to return?",
            text: "Once Return, This will return your money!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
            swal("Cancel!");
            }
        });
    });
</script>

<script>  
    $(document).on("click", "#cancel_order", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to cancel?",
            text: "Once Cancel, This will cancel your order!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
            swal("Order Safe!");
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

    if(window.location.href.indexOf('#exampleModal') != -1) {
    $('#exampleModal').modal('show');
    }

    });
</script>

@yield('js')
</body>

</html>