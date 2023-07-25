@extends('theme.marcus.layout.main')

@section('content')
<section class="grid-shop" style="margin-top: 200px">
    <!-- .grid-shop -->
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
            <div class="col-md-8">
                <ol>
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Accessories</li>
                </ol>
            </div>
            <div class="col-md-4 text-right">
                <h2>Accessories</h2>
            </div>
            </div>				
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- left-side --->
            @include('theme.marcus.products.sidebar')
            <!-- /left-side --->
            <!-- right-side --->
            <div class="col-sm-9 col-md-9">
                <div class="grid-banner">
                <img src="assets/images/10_grid_view_box_layout/banner_image.jpg" alt="2" /> </div>
                <div class="grid-spr">
                    <div class="row">
                    <div class="col-lg-5"> 
                        <a href="/products" class="grid-view-icon"><i class="fa fa-th-large" aria-hidden="true"></i></a> 
                        <strong>Showing  1-16  of  80 items</strong>
                    </div>
                    {{-- <div class="col-lg-7">
                        <div class="select-option grd-option">
                            <strong>Sortby</strong>
                            <a class="btn btn-default btn-select options2">
                                <input type="hidden" class="btn-select-input" id="1" name="1" value="" />
                                <span class="btn-select-value">Best sellers</span>
                                <span class="btn-select-arrow fa fa-angle-down"></span>
                                <ul>
                                    <li class="selected">Best sellers</li>
                                    <li>Option 1</li>
                                    <li>Option 2</li>
                                    <li>Option 3</li>
                                    <li>Option 4</li>
                                </ul>
                            </a>
                        </div>
                        <div class="select-option grd-option">
                            <strong>Show</strong>
                            <a class="btn btn-default btn-select options2">
                                <input type="hidden" class="btn-select-input" id="2" name="2" value="" />
                                <span class="btn-select-value">Select an Item</span>
                                <span class="btn-select-arrow fa fa-angle-down"></span>
                                <ul>
                                    <li class="selected">12</li>
                                    <li>Option 1</li>
                                    <li>Option 2</li>
                                    <li>Option 3</li>
                                    <li>Option 4</li>
                                </ul>
                            </a>
                        </div>
                    </div> --}}
                    </div>
                </div>
                <div class="row">
                    @include('theme.marcus.products.grid_view')
                    {{-- @include('theme.marcus.products.list_view') --}}
                    {{-- <div class="col-lg-4">
                        <!-- .pro-text -->
                        <div class="pro-text">
                            <!-- .pro-img -->
                            <div class="pro-img">
                                <img src="assets/images/10_grid_view_box_layout/product_01.jpg" alt="2" />
                                <a href="#" class="favorite"><i class="material-icons">&#xE87D;</i></a>
                            </div>
                            <!-- /.pro-img -->
                            <div class="pro-text-outer">
                                <span>T-shirt, Skirts</span>
                                <a href="shop-detail.html">
                                    <h4>Bonorum et Malorum </h4>
                                </a>
                                <div class="wk-price">$450.00
                                    <div class="in-stock"><i class="material-icons">&#xE5CA;</i> In stock</div>
                                </div>

                                <a href="#" class="add-btn"><i class="material-icons">&#xE8CC;</i> Add to cart</a>
                                <a href="#" class="eys-btn"><i class="material-icons">&#xE164;</i></a>
                                <a href="#" class="eys-btn" data-toggle="modal" data-target="#quickModal" data-whatever="@mdo"><i class="material-icons">&#xE417;</i></a> 
                            </div>
                        </div>
                        <!-- /.pro-text -->
                    </div> --}}
                
                    <div class="col-lg-12 text-center">
                        <a href="#" class="load-more">Load more</a>
                    </div>
                </div>

            </div>
            <!-- /right-side --->
        </div>
    </div>
    <!-- /.grid-shop -->
</section>
@endsection