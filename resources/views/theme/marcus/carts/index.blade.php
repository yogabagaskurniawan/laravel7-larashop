@extends('theme.marcus.layout.main')

@section('content')
<section class="shopping-cart" style="margin-top: 200px">
    <div class="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ol>
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Shopping cart</li>
            </ol>
          </div>
          <div class="col-md-4 text-right">
            <h2>Shopping cart</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- .shopping-cart -->
    <div class="container">
      <div class="title text-center">
        <h3>shopping cart</h3>
        <p>Nemo enim ipsam voluptatem quia voluptas</p>
      </div>
      <div class="row">
        <form method="POST" action="{{ url('carts/update') }}">
          @csrf
          <div class="col-md-12">
            <table>
              <tr>
                <th class="text-center">Product</th>
                {{-- <th>Product code</th>
                <th>Color & Size</th> --}}
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Edit</th>
              </tr>
              @forelse ($items as $item)
              @php
                $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
                $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
              @endphp
              <tr>
                <td>
                  {{-- <img src="assets/images/15_shopping_cart_v1/product_01.jpg" alt="13"/> --}}
                  <a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
                  <ul class="shop-ul shop-ul2">
                    <li><strong><a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a></strong></li>
                  </ul>
                </td>
                {{-- <td>M3012456</td> --}}
                {{-- <td>
                  <ul class="shop-ul">
                    <li>size: <span>09 </span></li>
                    <li>color: <span>brown</span></li>
                  </ul>
                </td> --}}
                <td><strong>{{ number_format($item->price) }}</strong></td>
                <td>
                  <div class="numbers-row">
                    {{-- <input type="text" name="french-hens" id="french-hens" value="1" /> --}}
                    <input type="number" id="french-hens" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" min="1" required>
                  </div>
                </td>
                <td><strong>{{ number_format($item->price * $item->quantity)}}</strong></td>
                <td>
                  {{-- <a href="#" class="red"><i class="material-icons">close</i></a> --}}
                  <a href="{{ url('carts/remove/'. $item->id)}}" class="red delete"><i class="material-icons">close</i></a>

                </td>
              </tr>
              @empty
                <tr>
                  <td colspan="6">The cart is empty!</td>
                </tr>
              @endforelse

            </table>
            <div class="col-lg-6">
              <a href="/products" class="shoppingbtn">Continue shopping</a>
            </div>
            <div class="col-lg-6 text-right">
              {{-- <a href="/carts/update" class="shoppingbtn">Update cart</a> --}}
              <input class="shoppingbtn" style="border: none" name="update_cart" value="Update cart" type="submit">
            </div>
            <div class="col-lg-4">
              {{-- <div class="shipping-outer">
                <h2>Estimate shipping cost and tax</h2>
                <div class="estimate">
                  <div class="col-lg-12 counttry">
                    <div class="lable">Country</div>
                    <input
                      name="counttry"
                      placeholder="United States (USA)"
                      type="text"
                    />
                  </div>
                  <div class="col-lg-12">
                    <div class="lable">State / Province</div>
                    <div class="size State">
                      <div class="select-option">
                        <select>
                          <option value="28">28</option>
                          <option value="32">32</option>
                          <option value="34">34</option>
                          <option value="36">36</option>
                          <option value="Featured Pots">State / City</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="lable">Zip/Postal Code</div>
                    <input name="counttry" placeholder="Zip Code" type="text" />
                  </div>
                </div>
              </div> --}}
            </div>
            <div class="col-lg-4">
              {{-- <div class="shipping-outer coupon">
                <h2>Shipping</h2>
                <ul>
                  <li>
                    <div class="shipping-list">
                      <input type="radio" />Free Shipping
                    </div>
                  </li>
                  <li>
                    <div class="shipping-list">
                      <input type="radio" />Next Day Delivery ($15)
                    </div>
                  </li>
                  <li>
                    <div class="shipping-list">
                      <p>Flat Rate</p>
                      <input type="radio" />Fixed $5.00
                    </div>
                  </li>
                  <li>Check Out with Multiple Addresses</li>
                </ul>
              </div>
              <div class="coupon-input">
                <input
                  name="counttry"
                  type="text"
                  placeholder="Type coupon code"
                />
                <a href="#">apply coupon</a>
              </div> --}}
            </div>

            <div class="col-lg-4">
              <div class="shipping-outer">
                <h2>cart totals</h2>
                <ul>
                  <li>Subtotal: <strong>{{ number_format(\Cart::getSubTotal()) }}</strong></li>
                  {{-- <li>
                    Shipping: 
                    <div class="shipping-list">
                      <p>Free  Shipping <input type="checkbox"></p>
                      <p>Next Day Delivery ($15) <input type="checkbox"></p>
                      <p>Flat Rate ($5) <input type="checkbox"></p>
                    </div>
                  </li> --}}
                  <li>ToTAL: <strong>{{ number_format(\Cart::getTotal()) }}</strong></li>
                  <li class="text-center">
                    <a href="#" class="redbutton">proceed checkout</a>
                    {{-- <a href="#" class="blackbutton">continue shopping</a> --}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.shopping-cart -->
  </section>
@endsection