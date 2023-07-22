@foreach($products as $product)
    <div class="product_item is_new">
        <div class="product_border"></div>
        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($product->image_one) }}" alt="" style="height: 100px; width:100px;"></div>
        <div class="product_content">
            @if($product->discount_price == NULL)
                <div class="product_price discount">Rs.{{ $product->selling_price }}</div>
            @else
                <div class="product_price discount">Rs.{{ $product->discount_price }}<span>Rs.{{ $product->selling_price }}</span></div>
            @endif
            <div class="product_name"><div><a href="{{ url('product/details/'.$product->id.'/'.$product->product_name) }}" tabindex="0">{{ $product->product_name }}</a></div></div>
        </div>
        <div class="product_fav"><i class="fas fa-heart"></i></div>
        <ul class="product_marks">
            @if($product->discount_price == NULL)
                <li class="product_mark product_new" style="background: blue;">New</li>
            @else
                <li class="product_mark product_new" style="background: red;">
                    @php
                        $amount = intval($product->selling_price) - intval($product->discount_price);
                        $discount = $amount/intval($product->selling_price)*100;
                    @endphp

                    {{ intval($discount) }}%
                </li>
            @endif
            
        </ul>
    </div>
@endforeach