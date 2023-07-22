@extends('layouts.app')

@section('content')

@include('layouts.menubar')

    @php 
        $setting = DB::table('sitesetting')->first();
        $charge = $setting->shipping_charge;
        $vat = $setting->vat;
    @endphp

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">

    <div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mr-4 mb-2" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Cart Products</div>
                        <div class="cart_items">
							<ul class="cart_list">
                                @foreach($cart as $row)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Product Image</b></div>
                                                <div class="cart_item_text"><img src="{{ asset( $row->options->image ) }}" alt="" style="width:70px; height:70px;"></div>
                                            </div>

                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Name</b></div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>
                                            @if($row->options->color != null)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Color</b></div>
                                                    <div class="cart_item_text">{{ $row->options->color }}</div>
                                                </div>
                                            @endif

                                            @if($row->options->size != null)
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title"><b>Size</b></div>
                                                    <div class="cart_item_text">{{ $row->options->size }}</div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title"><b>Quantity</b></div>
                                                <div class="cart_item_text">{{ $row->qty }}</div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title"><b>Price</b></div>
                                                <div class="cart_item_text">Rs. {{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title"><b>Total</b></div>
                                                <div class="cart_item_text">Rs. {{ $row->price*$row->qty }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
							</ul>
						</div>
                        <ul class="list-group col-lg-8" style="float: right;">
                            @if(Session::has('coupon'))
                                <li class="list-group-item">Sub Total: <span style="float:right;">Rs. {{ Cart::Subtotal() }}</span></li>
                                <li class="list-group-item">Coupon Amount: ({{ Session::get('coupon')['name'] }}) <span style="float:right;">Rs. {{ Session::get('coupon')['discount'] }}</span></li>
                            @else
                                <li class="list-group-item">Sub Total: <span style="float:right;">Rs. {{ Cart::Subtotal() }}</span></li>
                            @endif
                            <li class="list-group-item">Delivery Charge: <span style="float:right;">Rs. {{ $charge }}</span></li>
                            <li class="list-group-item">VAT(%): <span style="float:right;">{{ $vat }}</span></li>
                            @if(Session::has('coupon'))
                                @php 
                                    $s_total = Session::get('coupon')['balance'] + $charge;
                                    $vat_amt = round(($s_total*$vat)/100);

                                    $grand_total = $s_total + $vat_amt;
                                @endphp
                                <li class="list-group-item">Total Amount: <span style="float:right;">Rs. {{ number_format($grand_total,'0','',',') }}</span></li>
                            @else
                                @php 
                                    $s_total = Cart::Subtotal() + $charge;
                                    $vat_amt = round(($s_total*$vat)/100);

                                    $grand_total = $s_total + $vat_amt;
                                @endphp
                                <li class="list-group-item">Total Amount: <span style="float:right;">Rs. {{ number_format($grand_total,'0','',',') }}</span></li>
                            @endif
                        </ul>
					</div>
				</div>

                <div class="col-lg-5" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Delivery Address</div>
                            @php 
                                $user_id = Auth::user()->id;
                                $address = DB::table('orders')->latest('orders.id')
                                        ->where('orders.user_id',$user_id)
                                        ->select('shipping.*')
                                        ->join('shipping','orders.id','shipping.order_id')
                                        ->first();
                                if($address != null) { @endphp
                                    <button type="button" class="btn btn-link float-right" id="loadAddress"><i class="fas fa-sync-alt"></i> Load Address</button>
                                    <br><br>
                                @php }
                            @endphp
                            
						<form action="{{ route('payment.process') }}" id="contact_form" method="post">
                            @csrf
							
							<div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="name" aria-describedby="emailHelp" placeholder="Enter Full Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" placeholder="Enter your Address" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control" id="city" name="city" aria-describedby="emailHelp" placeholder="Enter your City" required>
                            </div>
                            <div class="contact_form_title text-center">Payment BY</div>
                            <div class="form-group">
                                <ul class="logos_list">
                                    <!-- <li><input type="radio" name="payment" value="stripe" checked><img src="{{ asset('public/frontend/images/mastercard.png') }}" style="width:106px; height:86px;"></li> -->

                                    <li><input type="radio" name="payment" value="oncash" checked>  <img src="{{ asset('public/frontend/images/cod.jpg') }}" style="width:135px; height:55px;"></li>

                                    <li><input type="radio" name="payment" value="bank">  <img src="{{ asset('public/frontend/images/bank-transfer.png') }}" style="width:163px; height:61px;"></li>
                                    

                                </ul>
                            </div>
                            <input type="hidden" name="payment_id" value="{{ time().'_'.Auth::user()->id }} ">
							<div class="contact_form_button text-center"><br>
								<button type="submit" class="btn btn-info">Pay Now</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>
@endsection

@section('js')
    <script src="{{ asset('public/frontend/js/custom.js')}}"></script>
    <script type="text/javascript">
        $('#loadAddress').click(function(){
            $.ajax({
                type: 'get',
                url: '/delivery/address',
                dataType: 'json',
                success:function(response){
                    $('#fullname').val(response.ship_name);
                    $('#phone').val(response.ship_phone);
                    $('#email').val(response.ship_email);
                    $('#address').val(response.ship_address);
                    $('#city').val(response.ship_city);
                }

            });
        });
    </script>
@endsection
