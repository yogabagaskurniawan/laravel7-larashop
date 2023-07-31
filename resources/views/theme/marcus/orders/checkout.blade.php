@extends('theme.marcus.layout.main')

@section('content')
<!-- header end -->
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
	<!-- checkout-area start -->
    <div class="container">
        <form method="POST" action="{{ url('orders/checkout') }}">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="checkbox-form">		
                        {{-- start Billing Detail --}}
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle">
                                <span class="material-icons">receipt</span> Billing Detail
                            </a>
                            </h4>
                        </div>
                        <div class="panel-body" style="margin-top: -30px">
                            <div class="shipping-outer">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">First Name <span class="required">*</span></div>
                                            <input type="text" id="first_name" value="{{ auth()->user()->first_name }}" name="first_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Last Name <span class="required">*</span></div>
                                            <input type="text" id="last_name" name="last_name" value="{{ auth()->user()->last_name }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Company Name</div>
                                            <input type="text" id="company" name="company">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Address <span class="required">*</span></div>
                                            <input type="text" id="address1" name="address1" required placeholder="Home number and street name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <input type="text" id="address2" name="address2" placeholder="Apartment, suite, unit etc. (optional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="counttry">
                                        {{-- provinsi --}}
                                        <div class="lable">Province<span class="required">*</span></div>
                                        <div class="size State">
                                            <div class="select-option">
                                                <select id="province_id" name="province_id" required>
                                                    <option value="" disabled selected>- Please Select -</option>
                                                    @foreach($provinces as $province_id => $province_name)
                                                        <option value="{{ $province_id }}" {{ Auth::user()->province_id == $province_id ? 'selected' : '' }}>
                                                            {{ $province_name }}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="counttry">
                                        {{-- city --}}
                                        <div class="lable">City<span class="required">*</span></div>
                                        <div class="size State">
                                            <div class="select-option">
                                                <select id="city_id" name="city_id" required>
                                                    <option value="" disabled selected>- Please Select -</option>
                                                    @foreach($cities as $city_id => $city_name)
                                                        <option value="{{ $city_id }}">{{ $city_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Postcode / Zip <span class="required">*</span></div>
                                            <input type="number" id="postcode" name="postcode" required placeholder="Postcode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Phone  <span class="required">*</span></div>
                                            <input type="text" id="phone" name="phone" required placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Email Address</div>
                                            <input type="email" id="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="counttry">
                                        <div class="lable">Order Notes</div>
                                        <textarea id="note" name="note" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end Billing Detail --}}

                        {{-- start Ship to a different address? --}}
                        {{-- <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle">
                                <span class="material-icons">flight_takeoff</span> Ship to a different address?
                            </a>
                            </h4>
                        </div>
                        <div class="panel-body" style="margin-top: -30px">
                            <div class="shipping-outer">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">First Name <span class="required">*</span></div>
                                            <input type="text" id="shipping_first_name" name="shipping_first_name"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Last Name <span class="required">*</span></div>
                                            <input type="text" id="shipping_last_name" name="shipping_last_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Company Name</div>
                                            <input type="text" id="shipping_company" name="shipping_company">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Address <span class="required">*</span></div>
                                            <input type="text" id="shipping_address1" name="shipping_address1" placeholder="Home number and street name">    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <input type="text" id="shipping_address2" name="shipping_address2" placeholder="Apartment, suite, unit etc. (optional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="counttry">
                                        <div class="lable">Province<span class="required">*</span></div>
                                        <div class="size State">
                                            <div class="select-option">
                                                <select id="shipping_province" name="shipping_province">
                                                    <option value="" disabled selected>- Please Select -</option>
                                                    @foreach($provinces as $province_id => $province_name)
                                                        <option value="{{ $province_id }}">{{ $province_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="counttry">
                                        <div class="lable">City<span class="required">*</span></div>
                                        <div class="size State">
                                            <div class="select-option">
                                                <select id="shipping_city" name="shipping_city">
                                                    <option value="" disabled selected>- Please Select -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Postcode / Zip <span class="required">*</span></div>
                                            <input type="number" id="shipping_postcode" name="shipping_postcode" placeholder="Postcode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Phone  <span class="required">*</span></div>
                                            <input type="text" id="shipping_phone" name="shipping_phone" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12 counttry">
                                            <div class="lable">Email Address</div>
                                            <input type="text" id="shipping_email" name="shipping_email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="counttry">
                                        <div class="lable">Order Notes</div>
                                        <textarea id="note" name="note" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- end Ship to a different address? --}}
                        {{-- <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Ship to a different address?</label>
                                    <input id="ship-box" type="checkbox" />
                                </h3>
                            </div>
                            <div id="ship-box-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>										
                                            <input type="text" id="shipping_first_name" name="shipping_first_name"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>										
                                            <input type="text" id="shipping_last_name" name="shipping_last_name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input type="text" id="shipping_company" name="shipping_company">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" id="shipping_address1" name="shipping_address1" placeholder="Home number and street name">    
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input type="text" id="shipping_address2" name="shipping_address2" placeholder="Apartment, suite, unit etc. (optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Province<span class="required">*</span></label>
                                            <select id="shipping_province" name="shipping_province">
                                                <option value="" disabled selected>- Please Select -</option>
                                                @foreach($provinces as $province_id => $province_name)
                                                    <option value="{{ $province_id }}">{{ $province_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>City<span class="required">*</span></label>
                                            <select id="shipping_city" name="shipping_city">
                                                <option value="" disabled selected>- Please Select -</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>										
                                            <input type="number" id="shipping_postcode" name="shipping_postcode" placeholder="Postcode">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone  <span class="required">*</span></label>										
                                            <input type="text" id="shipping_phone" name="shipping_phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email </label>										
                                            <input type="text" id="shipping_email" name="shipping_email" placeholder="Email">
                                        </div>
                                    </div>	
                                </div>					
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list mrg-nn">
                                    <label>Order Notes</label>
                                    <textarea id="note" name="note" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>									
                            </div>
                        </div>													 --}}
                    </div>
                </div>	
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="checkbox-form">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle">
                                <span class="material-icons">done_all</span> Your Order
                            </a>
                            </h4>
                        </div>
                        <div class="panel-body" style="margin-top: 30px">
                            {{-- <div class="table table-responsive"> --}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>							
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            @php
                                                $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
                                                $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
                                            @endphp
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $item->name }}	<strong class="product-quantity"> × {{ $item->quantity }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ number_format(\Cart::get($item->id)->getPriceSum()) }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">The cart is empty! </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">{{ number_format(\Cart::getSubTotal()) }}</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Tax</th>
                                            <td><span class="amount">{{ number_format(\Cart::getCondition('TAX 10%')->getCalculatedValue(\Cart::getSubTotal())) }}</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Shipping Cost ({{ $totalWeight }} kg)</th>
                                            <td>
                                                {{-- <select id="shipping-cost-option" required></select> --}}
                                                {{-- <div class="size State"> --}}
                                                    <div class="select-option">
                                                        <select style="width: 200px" id="shipping-cost-option" required></select>
                                                    </div>
                                                {{-- </div> --}}
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="total-amount">{{ number_format(\Cart::getTotal()) }}</span></strong>
                                            </td>
                                        </tr>								
                                    </tfoot>
                                </table>
                            {{-- </div> --}}
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div class="panel-group" id="faq">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment-1">Direct Bank Transfer.</a></h5>
                                            </div>
                                            <div id="payment-1" class="panel-collapse collapse show">
                                                <div class="panel-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2">Cheque Payment</a></h5>
                                            </div>
                                            <div id="payment-2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-3">PayPal</a></h5>
                                            </div>
                                            <div id="payment-3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input style="width: 100%; margin: 0 15px" type="submit" class="btn btn-primary" value="Place order" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
	<!-- checkout-area end -->	
@endsection