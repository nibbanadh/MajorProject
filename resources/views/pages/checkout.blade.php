@extends('layouts.app')

@section('content')

@include('layouts.menubar')

    @php 
        $setting = DB::table('sitesetting')->first();
        $charge = $setting->shipping_charge;
        $vat = $setting->vat;
    @endphp

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">

	<!-- Cart -->
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title">Checkout</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($cart as $row)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image text-center"><br><img src="{{ asset( $row->options->image ) }}" alt="" style="width:70px; height:70px;"></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>
                                            @if($row->options->color != null)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text">{{ $row->options->color }}</div>
                                                </div>
                                            @endif

                                            @if($row->options->size != null)
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text">{{ $row->options->size }}</div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div><br>
                                                <form method="post" action="{{ route('update.cartitem') }}">
                                                    @csrf
                                                    <input type="hidden" name="productId" value="{{ $row->rowId }}">
                                                    <input type="number" name="qty" value="{{ $row->qty }}" style="width:50px;">
                                                    <button type="submit" title="Update" class="btn btn-success btn-sm"><i class="fas fa-upload"></i></button>
                                                </form>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">Rs. {{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">Rs. {{ $row->price*$row->qty }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Action</div><br>   
                                                <a href="{{ url('remove/cart/'.$row->rowId ) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
							</ul>
						</div>
						
						<!-- Order Total -->
						<div class="order_total_content" style="padding: 15px;">
                            @if(Session::has('coupon'))
                            @else
                                <h5 class="ml-3">Apply Coupon</h5>
                                <form method="post" action="{{ route('apply.coupon') }}">
                                    @csrf
                                    <div class="form-group col-lg-4">
                                        <input type="text" name="coupon" class="form-control" required="" placeholder="Enter Your Coupon">
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-3">Apply</button>
                                </form>
                            @endif
                        </div>

                        
                            <ul class="list-group col-lg-4" style="float: right;">
                                @if(Session::has('coupon'))
                                    <li class="list-group-item">Sub Total: <span style="float:right;">Rs. {{ Cart::Subtotal() }}</span></li>

                                    <li class="list-group-item">Coupon Amount: ({{ Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="btn btn-sm" title="Remove Coupon"><i class="far fa-times-circle" style="color:red;"></i></a><span style="float:right;">Rs. {{ Session::get('coupon')['discount'] }}</span></li>
                                @else
                                    <li class="list-group-item">Sub Total: <span style="float:right;">Rs. {{ Cart::Subtotal() }}</span></li>
                                @endif
                                <li class="list-group-item">Delivery Charge: <span style="float:right;">Rs. {{ $charge }}</span></li>
                                <li class="list-group-item">VAT(%): <span style="float:right;">{{ $vat }}</span></li>
                                @if(Session::has('coupon'))
                                    @php 
                                    $s_total = Session::get('coupon')['balance'] + $charge;
                                    $vat_amt = round(($s_total*$vat)/100);

                                    $grand_total = Session::get('coupon')['balance'] + $charge + $vat_amt;
                                    @endphp
                                    <li class="list-group-item">Total Amount: <span style="float:right;">Rs. {{ number_format($grand_total,'0','',',') }}</span></li>
                                @else
                                    @php 
                                    $s_total = Cart::Subtotal() + $charge;
                                    $vat_amt = round(($s_total*$vat)/100);

                                    $grand_total = Cart::Subtotal() + $charge + $vat_amt;
                                    @endphp
                                    <li class="list-group-item">Total Amount: <span style="float:right;">Rs. {{ number_format($grand_total,'0','',',') }}</span></li>
                                @endif
                            </ul>
                        
                        
                        </div>
                        </div>
                        </div>
						<div class="cart_buttons">
							<a href="{{ route('show.cart') }}" class="button cart_button_clear">Back</a>
							<a href="{{ route('payment.step') }}" class="button cart_button_checkout">Proceed Payment</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="{{ asset('public/frontend/js/custom.js')}}"></script>
@endsection