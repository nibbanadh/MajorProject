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
						<div class="cart_title">Wishlist Products</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($product as $row)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image text-center"><br><img src="{{ asset( $row->image_one ) }}" alt="" style="width:70px; height:70px;"></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $row->product_name }}</div>
                                            </div>
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Product Code</div>
                                                <div class="cart_item_text">{{ $row->product_code }}</div>
                                            </div>
                                            @if($row->discount_price != null)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Price</div>
                                                    <div class="cart_item_text">{{ $row->discount_price }}</div>
                                                </div>
                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Price</div>
                                                    <div class="cart_item_text">{{ $row->selling_price }}</div>
                                                </div>
                                            @endif

                                            @if($row->product_color != null)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text">{{ $row->product_color }}</div>
                                                </div>
                                            @endif

                                            @if($row->product_size != null)
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text">{{ $row->product_size }}</div>
                                                </div>
                                            @endif
                                            
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Action</div><br>
                                                <button id="{{ $row->id }}" class="btn btn-sm btn-primary addCart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
							</ul>
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
                                <li class="list-group-item">Available Quantity: <span id="pstock" ></span></li>
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
                                    <input type="number" id="quantity_num" class="form-control ml-2" name="qty" min="1" max="" value="1" style="width:80px;">
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
                    console.log(data);
                    $('#product_id').val(data.product.id);
                    $('#pname').text(data.product.product_name);
                    $('#pimage').attr('src','/'+data.product.image_one);
                    $('#pcode').text(data.product.product_code);
                    $('#pcatalog').text(data.product.category_name);
                    $('#pcategory').text(data.product.subcategory_name);
                    $('#pstock').text(data.product.product_quantity);
                    $('#quantity_num').val(1);
                    $('#quantity_num').attr('max',data.product.product_quantity);
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




@endsection