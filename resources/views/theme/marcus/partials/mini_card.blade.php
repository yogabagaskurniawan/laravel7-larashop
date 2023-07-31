<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><i class="material-icons"></i></span> <span class="subno">{{ \Cart::getTotalQuantity() }}</span></a>
    @if (!\Cart::isEmpty())
    <div class="dropdown-menu cart-outer">
        @foreach (\Cart::getContent() as $item)
        @php
            $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
            $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
        @endphp
        <div class="cart-content">
            <div class="col-sm-4 col-md-4">
                {{-- <img src="assets/images/01_homepage_v1/product_image_02.jpg" alt="2" /> --}}
                <a href="{{ url('product/'. $product->slug) }}">
                    <img src="{{ $image }}" alt="{{ $product->name }}" style="width:80px">
                </a>
            </div>
            <div class="col-sm-8 col-md-8">
                <div class="pro-text">
                    <a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a>
                    <span>{{ $item->quantity }} × <span class="price">{{ number_format($item->price) }}</span></span>
                    <div class="eidt-outer">
                        <a href="{{ url('carts/remove/'. $item->id)}}" class="close2"><span class="material-icons">delete</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="total">
            <div class="col-md-6 text-left">											
                <strong class="sub-total">Sub Total</strong>
            </div>
            <div class="col-md-6 text-right">
                <strong>{{ number_format(\Cart::getSubTotal()) }}</strong>
            </div>
        </div>
        <a href="{{ '/carts' }}" class="cart-btn"><span class="material-icons"></span> VIEW CART </a>
        <a href="{{ url('orders/checkout') }}" class="cart-btn"><span class="material-icons">reply</span> CHECKOUT</a>
    </div>
    @endif
</li>