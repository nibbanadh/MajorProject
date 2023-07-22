@extends('layouts.app')

@section('content')

@include('layouts.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">

	<!-- Cart -->
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($cart as $row)
                                    <?php $product_stock= DB::table('products')->select('product_quantity','buying_limit')->where('id',$row->id)->get(); ?>
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
                                                    <input type="number" id="qty_input{{$row->id}}" name="qty" value="{{ $row->qty }}" min="{{$product_stock[0]->buying_limit}}" max="{{$product_stock[0]->product_quantity}}" style="width:50px;">
                                                    <span>of <span id="product_stock{{$row->id}}">{{$product_stock[0]->product_quantity}}</span> available stock</span>
                                                    <button type="submit" title="Update" class="btn btn-success btn-sm"><i class="fas fa-upload"></i></button>
                                                </form>
                                                <div class="cart_item_text"></div>
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
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Total Amount:</div>
								<div class="order_total_amount">Rs. {{ Cart::total() }}</div>
							</div>
						</div>
                        
						<div class="cart_buttons">
							<a href="{{ url('delete/cart/all' ) }}" class="button cart_button_clear">Cancel All</a>
							<a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
    <script src="{{ asset('public/frontend/js/cart_custom.js')}}"></script>
@endsection