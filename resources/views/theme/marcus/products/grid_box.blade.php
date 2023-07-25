<div class="col-lg-4" >
    <!-- .pro-text -->
    <div class="pro-text" style="padding-left: 20px;">
        <!-- .pro-img -->
        <div class="pro-img">
            <a href="{{ url('product/'. $product->slug) }}">
				@if ($product->productImages->first())
					<img src="{{ asset('storage/'.$product->productImages->first()->path) }}" alt="{{ $product->name }}">
				@else
                    <img src="{{ asset('theme/marcus/assets/images/10_grid_view_box_layout/product_01.jpg') }}" alt="{{ $product->name }}" />
				@endif
			</a>
            {{-- <a href="#" class="favorite"><i class="material-icons">&#xE87D;</i></a> --}}
        </div>
        <!-- /.pro-img -->
        <div class="pro-text-outer">
            {{-- <span>T-shirt, Skirts</span> --}}
            <a href="{{ url('product/'. $product->slug) }}">
                <h4>{{ $product->name }}</h4>
            </a>
            <div class="wk-price">{{ number_format($product->price_label()) }}
                <div class="in-stock"><i class="material-icons">&#xE5CA;</i> In stock</div>
            </div>

            <a href="#" class="add-btn"><i class="material-icons">&#xE8CC;</i> Add to cart</a>
            <a href="#" class="eys-btn"><i class="material-icons">&#xE164;</i></a>
            <a href="#" class="eys-btn" data-toggle="modal" data-target="#quickModal" data-whatever="@mdo"><i class="material-icons">&#xE417;</i></a> 
        </div>
    </div>
    <!-- /.pro-text -->
</div>