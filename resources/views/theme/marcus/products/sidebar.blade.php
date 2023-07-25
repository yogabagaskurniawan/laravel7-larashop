<div class="col-sm-3 col-md-3">
    @if ($categories)
    <div class="weight">
        <div class="title">
            <h2>categories</h2>
        </div>
        <div class="product-categories">
            <ul>
                @foreach ($categories as $category)
                <li><a href="{{ url('products?category='. $category->slug) }}">{{ $category->name }}</a></li> 
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="weight">
        <div class="title">
            <h2>brands <i class="material-icons">&#xE313;</i></h2>
        </div>
        <div class="product-categories">
            <ul>
                <li><a href="#">Addidas</a></li>
                <li><a href="#">Addidas Neo  </a></li>
                <li><a href="#">Fastrack </a></li>
                <li><a href="#">Jack & Jones </a></li>
                <li><a href="#">Nike</a></li>
                <li><a href="#">Peter England </a></li>
                <li><a href="#">Puma </a></li>
                <li><a href="#">Zovi </a></li>
                <li><a href="#">29 more </a></li>
            </ul>
        </div>				
    </div>
    <div class="weight">
        <div class="title">
            <h2>price <i class="material-icons">&#xE313;</i></h2>
        </div>
        <div class="product-categories">
            <ul>
                <li><a href="#"><i class="material-icons">done</i> Below $100.00</a></li>
                <li><a href="#"><i class="material-icons">done</i> $100.00-999.00  </a></li>
                <li><a href="#"><i class="material-icons">done</i> $1000.00-1999.00 </a></li>
                <li><a href="#"><i class="material-icons">done</i> $2000.00-4999.00 </a></li>
            </ul>
        </div>				
    </div>
    <div class="weight">							
        <div class="title">
            <h2>colors filter <i class="material-icons">&#xE313;</i></h2>
        </div> 
        <div class="color">
                <ul>
                    <li><a href="#" class="color-1"><span ></span> Verdigris </a></li>
                    <li><a href="#" class="color-2"><span ></span> Curious Blue</a></li>
                    <li><a href="#" class="color-3"><span ></span> Tahiti Gold</a></li>
                    <li><a href="#" class="color-4"><span ></span> Deep Lilac</a></li>
                    <li><a href="#" class="color-5"><span ></span> Medium Sea Green</a></li>
                    <li><a href="#" class="color-6"><span ></span> Cranberry</a></li>
                    <li><a href="#"><i class="material-icons">add</i> More Colors</a></li>
                </ul>
            </div>							

    </div>
    <div class="weight">							
        <div class="title">
            <h2>size filter <i class="material-icons">&#xE313;</i></h2>
        </div> 

            <div class="size">
                <ul>
                    <li><a href="#">6 </a></li>
                    <li><a href="#">7 </a></li>
                    <li><a href="#">8 </a></li>
                    <li><a href="#">9 </a></li>
                    <li><a href="#">10 </a></li>
                    <li><a href="#">11 </a></li>
                    <li><a href="#">12 </a></li>
                    <li><a href="#">XL</a></li>
                    <li><a href="#">XXL</a></li>
                    <li><a href="#">3XL</a></li>
                </ul>
            </div>

    </div>
    <div class="weight">
        <div class="title">
            <h2>best seller</h2>
        </div>
        <div class="toprating-box">
            <ul>
                <li>
                    <div class="e-product">
                        <div class="pro-img"> <img src="assets/images/10_grid_view_box_layout/best_seller_product_01.jpg" alt="2"> </div>
                        <div class="pro-text-outer"> 
                            <a href="#">
                                <h4> A handful of model sent ence </h4>
                            </a>
                            <p class="wk-price">$290.00 </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="e-product">
                        <div class="pro-img"> <img src="assets/images/10_grid_view_box_layout/best_seller_product_02.jpg" alt="2"></div>
                        <div class="pro-text-outer">
                            <a href="#">
                                <h4> A handful of model sent ence </h4>
                            </a>
                            <p class="wk-price">$290.00 </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="e-product">
                        <div class="pro-img"> <img src="assets/images/10_grid_view_box_layout/best_seller_product_03.jpg" alt="2"> </div>
                        <div class="pro-text-outer">
                            <a href="#">
                                <h4> A handful of model sent ence </h4>
                            </a>
                            <p class="wk-price">$290.00 </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="e-product">
                        <div class="pro-img"> <img src="assets/images/10_grid_view_box_layout/best_seller_product_04.jpg" alt="2"> </div>
                        <div class="pro-text-outer">
                            <a href="#">
                                <h4> A handful of model sent ence </h4>
                            </a>
                            <p class="wk-price">$290.00 </p>
                        </div>
                    </div>
                </li>								
            </ul>
        </div>
    </div>
</div>