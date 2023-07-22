<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="ecommerce product">
    <meta name="author" content=" ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{setting('company_name')}}</title>

    <!-- favicon -->
    <link rel="icon" href="{{  asset(setting('logo')) }}" type="image/gif" sizes="16x16">

    <!-- vendor css -->
    <link href="{{ asset('public/backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

     <!-- Tags Input CDN CSS -->
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/starlight.css') }}">
    <link href="{{ asset('public/backend/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Datatable -->
    <link href="{{ asset('public/backend/lib/highlightjs/github.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        #datatable1 {
            width:100%!important;
        }

        .admin-user-icon{
            background: #5b8ebe;
            padding: 8px 12px 8px 12px;
            color: white;
            font-size: 14px;
            font-weight: 700;
            border: 3px solid #6f42c1;
        }
    </style>
  </head>

  <body>

    @guest

    @else
        <!-- ########## START: LEFT PANEL ########## -->
        <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i>{{setting('company_name')}}</a></div>
        <div class="sl-sideleft">

        <div class="sl-sideleft-menu">
            <a href="{{ url('admin/home') }}" class="sl-menu-link active">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            
            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Category</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Catalog</a></li>
                <li class="nav-item"><a href="{{ route('sub.categories') }}" class="nav-link">Category</a></li>
                <li class="nav-item"><a href="{{ route('mini.categories') }}" class="nav-link">Sub Category</a></li>
                <li class="nav-item"><a href="{{ route('brands') }}" class="nav-link">Brand</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">Coupons</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.coupon') }}" class="nav-link">All Coupon</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">Vendor</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('add.vendor') }}" class="nav-link">Add Vendor</a></li>
                <li class="nav-item"><a href="{{ route('all.vendor') }}" class="nav-link">All Vendor</a></li>
            </ul>
            
            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Products</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('add.product')}}" class="nav-link">Add Product</a></li>
            <li class="nav-item"><a href="{{route('all.product')}}" class="nav-link">All Product</a></li>
            
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Orders</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('admin.neworder')}}" class="nav-link">New Order</a></li>
            <li class="nav-item"><a href="{{route('admin.accept.payment')}}" class="nav-link">Accept Payment</a></li>
            <li class="nav-item"><a href="{{route('admin.cancel.order')}}" class="nav-link">Cancel Order</a></li>
            <li class="nav-item"><a href="{{route('admin.process.order')}}" class="nav-link">Process Delivery</a></li>
            <li class="nav-item"><a href="{{route('admin.success.delivery')}}" class="nav-link">Delivery Success</a></li>
            
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Blog</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('add.blog.categorylist') }}" class="nav-link">Blog Category</a></li>
            <li class="nav-item"><a href="{{ route('add.blogpost') }}" class="nav-link">Add Post</a></li>
            <li class="nav-item"><a href="{{ route('all.blogpost') }}" class="nav-link">Post List</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Others</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.newslater') }}" class="nav-link">Newslaters</a></li>
                <li class="nav-item"><a href="{{ route('admin.seo') }}" class="nav-link">SEO Setting</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Reports</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('today.order') }}" class="nav-link">Today Order</a></li>
                <li class="nav-item"><a href="{{ route('today.delivery') }}" class="nav-link">Today Delivery</a></li>
                <li class="nav-item"><a href="{{ route('this.month') }}" class="nav-link">This Month</a></li>
                <li class="nav-item"><a href="{{ route('search.report') }}" class="nav-link">Search Report</a></li>
                <li class="nav-item"><a href="{{ route('admin.stock.sell') }}" class="nav-link">Sold Product</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">User Role</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('create.admin') }}" class="nav-link">Create User</a></li>
                <li class="nav-item"><a href="{{ route('admin.all.user') }}" class="nav-link">All User</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Return Order</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.return.request') }}" class="nav-link">Return Request</a></li>
                <li class="nav-item"><a href="{{ route('admin.all.return') }}" class="nav-link">All Request</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Product Stocks</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.product.stock') }}" class="nav-link">Stock</a></li>
                <li class="nav-item"><a href="{{ route('admin.stock.empty') }}" class="nav-link">Empty Stock</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Contact Message</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
        
                <li class="nav-item"><a href="{{ route('all.message') }}" class="nav-link">All Message</a></li>
            </ul>

            <!-- <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Product Comments</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div> menu-item 
            </a> sl-menu-link -->
            <!--<ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('today.order') }}" class="nav-link">New Comment</a></li>
                <li class="nav-item"><a href="{{ route('today.delivery') }}" class="nav-link">All Comment</a></li>
            </ul> -->

            <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Site Setting</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.site.setting') }}" class="nav-link">Site Setting</a></li>
            </ul>
        </div><!-- sl-sideleft-menu -->

        <br>
        </div><!-- sl-sideleft -->
        <!-- ########## END: LEFT PANEL ########## -->

        <!-- ########## START: HEAD PANEL ########## -->
        <div class="sl-header">
            <div class="sl-header-left">
                <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
                <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
            </div><!-- sl-header-left -->
            <div class="sl-header-right">
                <nav class="nav">
                <div class="dropdown">
                    <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name">{{ Auth::user()->name }}</span>
                    <!-- <img src="{{ asset('public/backend/img/img3.jpg') }}" class="wd-32 rounded-circle" alt=""> -->
                    <span class="admin-user-icon rounded-circle"><?php echo(strtoupper(substr(Auth::user()->name, 0, 1))); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <!-- <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li> -->
                        <li><a href="{{ route('admin.password.change') }}"><i class="icon ion-ios-gear-outline"></i> Change Password</a></li>
                        <li><a href="{{ route('admin.logout') }}"><i class="icon ion-power"></i> Sign Out</a></li>
                    </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
                </nav>

                @php
                    $unread_notifications = DB::table('notifications')->whereNull('read_at')->get();
                    $count_notif = count($unread_notifications);
                @endphp

                <div class="navicon-right">
                <a id="btnRightMenu" href="" class="pos-relative">
                    <i class="icon ion-ios-bell-outline"></i>
                    <!-- start: if statement -->
                    @if($count_notif != 0)
                        <span class="square-8 bg-danger"></span>
                    @else
                        <span class="square-8 bg-danger" id="square_indicator" style="display:none"></span>
                    @endif    
                    <!-- end: if statement -->
                </a>
                </div><!-- navicon-right -->
            </div><!-- sl-header-right -->
        </div><!-- sl-header -->
        <!-- ########## END: HEAD PANEL ########## -->


        <!-- ########## START: RIGHT PANEL ########## -->
        <div class="sl-sideright">
            <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
                <!-- <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
                </li> -->
                <li class="nav-item">
                <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (<span id="count_notification">{{ $count_notif }}</span>)</a>
                </li>
                <li class="nav-item">
                <a class="nav-link"  href="{{ route('clear.notification') }}">Clear All</a>
                </li>
            </ul><!-- sidebar-tabs -->

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane pos-absolute a-0 mg-t-60" id="messages" role="tabpanel">
                    <div class="media-list">
                        <!-- loop starts here -->
                        <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{ asset('public/backend/img/img3.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                            <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
                            <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                        </a>
                        <!-- loop ends here -->
                        <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{ asset('public/backend/img/img4.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Samantha Francis</p>
                            <span class="d-block tx-11 tx-gray-500">3 hours ago</span>
                            <p class="tx-13 mg-t-10 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                        </a>
                        <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{ asset('public/backend/img/img7.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Robert Walker</p>
                            <span class="d-block tx-11 tx-gray-500">5 hours ago</span>
                            <p class="tx-13 mg-t-10 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
                            </div>
                        </div><!-- media -->
                        </a>
                        <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{ asset('public/backend/img/img5.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Larry Smith</p>
                            <span class="d-block tx-11 tx-gray-500">Yesterday, 8:34pm</span>

                            <p class="tx-13 mg-t-10 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                            </div>
                        </div><!-- media -->
                        </a>
                        <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{ asset('public/backend/img/img3.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                            <span class="d-block tx-11 tx-gray-500">Jan 23, 2:32am</span>
                            <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                        </a>
                    </div><!-- media-list -->
                    <div class="pd-15">
                        <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
                    </div>
                </div><!-- #messages -->


                <div class="tab-pane pos-absolute a-0 mg-t-60 active overflow-y-auto" id="notifications" role="tabpanel">
                    <div class="media-list" id="media_list">
                        <!-- loop starts here -->
                        @include('admin.notification')
                        
                    </div><!-- media-list -->
                </div><!-- #notifications -->

            </div><!-- tab-content -->
        </div><!-- sl-sideright -->
        <!-- ########## END: RIGHT PANEL ########## --->

        
    @endguest
    @yield('admin_content')

    <script src="{{ asset('public/backend/lib/jquery/jquery.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('public/backend/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('public/backend/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('public/backend/lib/highlightjs/highlight.pack.js') }}"></script>
    <script src="{{ asset('public/backend/lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/backend/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('public/backend/lib/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


    <!-- for notification pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('11f9b308cbdf0ce3a815', {
        cluster: 'ap2'
        });

        var channel = pusher.subscribe('orderChannel');
        channel.bind('order_submitted', function(data) {
            console.log(data);
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/admin/countNotification",
                type:"POST",
                data: {
                    _token: _token,
                },
                success:function(data){
                    if(data != 0)
                    {
                        $('#square_indicator').show();
                    }else{
                       $('#square_indicator').hide(); 
                    }
                    $('#count_notification').text(data);
                    $.ajax({
                        url: "/admin/myevent",
                        type:"GET",
                        success:function(response){
                            
                            document.getElementById('media_list').innerHTML = response;
                        }
                    });
                }
            });
            
        });

    </script>
    <script>
        function markAsRead(id,user_id){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/admin/notification/read",
                type:"POST",
                data:{
                    id:id,
                    user_id:user_id,
                    _token: _token
                },
                success:function(response){
                    if(response) {
                        console.log(response);
                    }
                },
            });
        }
    </script>



    <script>
      $(function(){
        'use strict';

        if($('#datatable1').hasClass('scrollable')){
            $('#datatable1').DataTable({
            responsive: false,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            },
            scrollX: true,  
            });    
        }else{
            $('#datatable1').DataTable({
            responsive: false,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            },
            scrollX: false,   
            });   
        }

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true,
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>

    <script src="{{ asset('public/backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/backend/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('public/backend/lib/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('public/backend/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('public/backend/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/backend/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/backend/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>


    <script src="{{ asset('public/backend/lib/medium-editor/medium-editor.js') }}"></script>
    <script src="{{ asset('public/backend/lib/summernote/summernote-bs4.min.js ') }}"></script>

    <script>
      $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>

    <script>
      $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote1').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>

    <script src="{{ asset('public/backend/js/starlight.js') }}"></script>
    <script src="{{ asset('public/backend/js/custom.js') }}"></script>
    <script src="{{ asset('public/backend/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('public/backend/js/dashboard.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
    <!-- Main js -->
    <script src="{{asset('public/panel/assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>



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
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                title: "Are you Want to delete?",
                text: "Once Delete, This will be Permanently Delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                swal("Safe Data!");
                }
            });
        });
    </script>
    
    @yield('js')
  </body>
</html>
