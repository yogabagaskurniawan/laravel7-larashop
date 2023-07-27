@extends('theme.marcus.layout.main')

@section('content')
<!-- grid-shop -->
<section class="grid-shop" style="margin-top: 200px">
  <!-- .grid-shop -->
  <div class="breadcrumb wihte-bg-brc">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <ol>
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Shopping cart</li>
          </ol>
        </div>
        <div class="col-md-4 text-right">
          <div class="next-outer">
            <ul>
              <li>
                <a href="#"
                  ><i class="material-icons">arrow_back</i> prev</a
                >
              </li>
              <li>
                <a href="#"
                  >next <i class="material-icons">arrow_forward</i></a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .shop-deails-bg -->
  <div class="shop-deails-bg2">
    <!-- left side -->
    <div class="col-sm-5 col-md-5">
      @forelse ($product->productImages as $image)
          <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
      @empty
        No image found!
      @endforelse
    </div>
    <!-- left side -->
    <!-- right side -->
    <div class="col-sm-4">
      <!-- .pro-text -->
      <div class="pro-text product-detail">
        <!-- /.pro-img -->
        {{-- <span class="span1">Incididunt ut labore magna</span> --}}
        {{-- <a href="#"> --}}
          <h4>{{ $product->name }}</h4>
        {{-- </a> --}}
        <p>
          <strong>{{ number_format($product->price_label()) }}</span>
        </p>
        <div class="star2">
          <ul>
            <li class="yellow-color">
              <i class="fa fa-star" aria-hidden="true"></i>
            </li>
            <li class="yellow-color">
              <i class="fa fa-star" aria-hidden="true"></i>
            </li>
            <li class="yellow-color">
              <i class="fa fa-star" aria-hidden="true"></i>
            </li>
            <li class="yellow-color">
              <i class="fa fa-star" aria-hidden="true"></i>
            </li>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <li><a href="#">10 review(s)</a></li>
            <li><a href="#"> Add your review</a></li>
          </ul>
        </div><p>        {{ $product->short_description }}</p>
        <hr />
        <div class="avalible-ul">
          <ul>
            {{-- <li>stock: <span>{{ $product->productInventory->qty }}</span></li> --}}
            <li>Product code: <span>{{ $product->sku }}</span></li>
            <li>
              Brand:
              <span>
                Lee <i class="material-icons green">check_circle</i></span
              >
              <span class="offer"
                ><i class="material-icons">card_giftcard</i> offers</span
              >
            </li>
            <li>
              Categories: 
              @foreach ($product->categories as $category)
                <span><a href="{{ url('products/category/'. $category->slug ) }}">{{ $category->name }}</a></span>
              @endforeach
              {{-- <span class="tag2">bags</span
              ><span class="tag2">clothes</span
              ><span class="tag2">shoes</span
              ><span class="tag2">dresses</span> --}}
            </li>
          </ul>
        </div>
        <hr />
        {{-- <div class="size">
          <p><strong>Select size :</strong></p>
          <ul>
            <li><a href="#">S</a></li>
            <li><a href="#">M</a></li>
            <li><a href="#">L</a></li>
            <li><a href="#">X</a></li>
            <li><a href="#">XL</a></li>
          </ul>
        </div> --}}

        <form action="{{ url('carts') }}" method="post">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          @if ($product->type == 'configurable')
            <div class="quick-view-select">
              <div class="select-option-part">
                <label>Size*</label>
                <select name="size" class="select" required>
                  <option value="">- Please Select -</option>
                  @foreach ($sizes as $value => $label)
                      <option value="{{ $value }}">{{ $label }}</option>
                  @endforeach
                </select>              
              </div>
              <div class="select-option-part">
                <label>Color*</label>
                <select name="color" class="select" required>
                  <option value="">- Please Select -</option>
                  @foreach ($colors as $value => $label)
                      <option value="{{ $value }}">{{ $label }}</option>
                  @endforeach
              </select>
              </div>
            </div>
          @endif
          {{-- <div class="numbers-row"><input type="text" name="qty" id="french-hens" value="1"/></div> --}}
          <div class="numbers-row">
            <input type="number" name="qty" style="width: 70px" id="french-hens" placeholder="qty" min="1" value="1" required>
            {{-- <input type="text" name="french-hens" id="french-hens" value="3"> --}}
            {{-- <div class="inc button">+</div>
            <div class="dec button">-</div> --}}
          </div>
        <button type="submit" style="border: none" class=" addtocart2"><span class="material-icons">shopping_cart</span>add to cart</button>


      </form>
        <a href="#" class="hart"
          ><span class="material-icons">favorite_border</span></a
        >
        <a href="#" class="hart"
          ><span class="material-icons">sort</span></a
        >
        <a href="#" class="hart"
          ><span class="material-icons">share</span></a
        >
      </div>
      <!-- /.pro-text -->
    </div>
  </div>
  <!-- /.shop-deails-bg -->
  <!-- .shop-deails-bg -->
  <div class="shop-deails-bg3">
    <!-- left side -->
    <div class="col-md-5">
      {{-- @forelse ($product->productImages as $image)
        <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
      @empty
        No image found!
      @endforelse --}}
    </div>
    <!-- left side -->
    <!-- right side -->
    <div class="col-sm-4">
      <!-- .pro-text -->
      <div class="tab-bg">
        <ul>
          <li><a data-toggle="tab" href="#home">Description</a></li>
          <li><a data-toggle="tab" href="#menu1"> Details</a></li>
          <li class="active">
            <a data-toggle="tab" href="#menu2">Comments</a>
          </li>
          <li><a data-toggle="tab" href="#menu3">Video</a></li>
          <li><a data-toggle="tab" href="#menu4">Custom tab</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div id="home" class="tab-pane fade">
          <div class="row">
            <div class="col-lg-12">
              {{ $product->description }}
            </div>
          </div>
        </div>
        <div id="menu1" class="tab-pane fade">
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy
            text ever since the 1500s, when anunknown printer took a galley
            of type and scrambled it to make a type specimen book. It has
            survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was
            popularised in the 1960s with the release of Letraset sheets
            containing Lorem Ipsum passages..
          </p>
          <ul>
            <li>Claritas est etiam processus dynamicus.</li>
            <li>Qui sequitur mutationem consuetudium lectorum.</li>
            <li>Claritas est etiam processus dynamicus.</li>
            <li>Qui sequitur mutationem consuetudium lectorum.</li>
            <li>Claritas est etiam processus dynamicus.</li>
            <li>Qui sequitur mutationem consuetudium lectorum.</li>
          </ul>
          <p>
            It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was
            popularised in the 1960s with the release.
          </p>
        </div>
        <div id="menu2" class="tab-pane fade in active">
          <div class="comment-tab2">
            <h5>
              3 Reviews for ‘Adah Fashions Georgette Dupatta Material’
            </h5>
            <div class="star2">
              <ul>
                <li class="yellow-color">
                  <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li class="yellow-color">
                  <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li class="yellow-color">
                  <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li class="yellow-color">
                  <i class="fa fa-star" aria-hidden="true"></i>
                </li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><a href="#">4/5 | 32 review (s)</a></li>
              </ul>
            </div>
            <div class="comment-text-outer">
              <div class="row">
                <div class="col-lg-2 text-center">
                  <img
                  src="{{ asset('theme/marcus/assets/images/08_product_detail_page/comment_image_02.jpg') }}"
                  alt="comment0image"
                  />
                  <strong>P Emma</strong>
                  <p>June 17</p>
                </div>
                <div class="col-lg-10">
                  <div class="star2">
                    <ul>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    </ul>
                  </div>
                  <h5>
                    Itaque earum rerum hic tenetur a sapiente delectus
                  </h5>
                  <br />
                  <p>
                    Sed ut perspiciatis unde omnis iste natus error sit
                    voluptatem accusantium doloremque laudantium, totam rem
                    aperiam, eaque ipsa quae ab illo inventore veritatis et
                    quasi architecto beatae vitae dicta sunt explicabo.
                  </p>
                  <div class="handup-rating">
                    <ul>
                      <li>
                        <a href="#"
                          ><i class="material-icons">thumb_up</i> (45)</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="material-icons">thumb_down</i> (45)</a
                        >
                      </li>
                    </ul>
                    <a href="#" class="reply"
                      ><i class="material-icons">reply</i> reply</a
                    >
                  </div>
                </div>
                <div class="col-lg-2 text-center">
                  <img
                    src="{{ asset('theme/marcus/assets/images/08_product_detail_page/comment_image_02.jpg') }}"
                    alt="comment0image"
                  />
                  <strong>M Donna</strong>
                  <p>June 17</p>
                </div>
                <div class="col-lg-10">
                  <div class="star2">
                    <ul>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li class="yellow-color">
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li>
                      <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    </ul>
                  </div>
                  <h5>
                    Itaque earum rerum hic tenetur a sapiente delectus
                  </h5>
                  <br />
                  <p>
                    Sed ut perspiciatis unde omnis iste natus error sit
                    voluptatem accusantium doloremque laudantium, totam rem
                    aperiam, eaque ipsa quae ab illo inventore veritatis et
                    quasi architecto beatae vitae dicta sunt explicabo.
                  </p>
                  <div class="handup-rating">
                    <ul>
                      <li>
                        <a href="#"
                          ><i class="material-icons">thumb_up</i> (45)</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="material-icons">thumb_down</i> (45)</a
                        >
                      </li>
                    </ul>
                    <a href="#" class="reply"
                      ><i class="material-icons">reply</i> reply</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- reveiew-comment -->
      <div class="review-comment">
        <div class="title text-center">
          <h2>write a review</h2>
          <p>Nemo enim ipsam voluptatem quia voluptas</p>
        </div>
        <div class="contact-form">
          <form
            action="#"
            method="post"
            id="commentform"
            class="comment-form"
          >
            <div class="row">
              <div class="col-md-6">
                <p class="comment-form-author">
                  <input
                    id="author"
                    name="author"
                    value=""
                    size="30"
                    placeholder="Name"
                    type="text"
                  />
                </p>
              </div>
              <div class="col-md-6">
                <p class="comment-form-email">
                  <input
                    id="email"
                    name="email"
                    value=""
                    size="30"
                    placeholder="email"
                    type="text"
                  />
                </p>
              </div>
              <div class="col-md-6">
                <p class="comment-form-email">
                  <input
                    id="review"
                    name="email"
                    value=""
                    size="30"
                    placeholder="Title of review :"
                    type="text"
                  />
                </p>
              </div>
              <div class="col-md-6">
                <p class="comment-form-email">
                  Rating: <i class="material-icons">star_border</i
                  ><i class="material-icons">star_border</i
                  ><i class="material-icons">star_border</i
                  ><i class="material-icons">star_border</i
                  ><i class="material-icons">star_border</i>
                </p>
              </div>
              <div class="col-md-12">
                <p class="comment-form-comment">
                  <textarea
                    id="comment"
                    name="comment"
                    cols="45"
                    rows="8"
                    placeholder="Comment"
                    aria-required="true"
                  ></textarea>
                </p>
              </div>
              <div class="col-md-12">
                <p class="form-submit">
                  <input
                    name="submit"
                    id="submit"
                    class="btn btn-secondary"
                    value="Send message"
                    type="submit"
                  />
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /reveiew-comment -->
      <!-- purchased product -->
      <div class="row">
        <div class="col-lg-12">
          <!-- title -->
          <div class="title text-center">
            <h2>also purchased</h2>
            <p>Mauris ac ipsum vitae diam finibus dignissim</p>
          </div>
          <!-- /title -->
          <!-- electonics -->
          <div class="electonics">
            <div class="col-md-12">
              <div class="row">
                <!-- tab-pane -->
                <div class="owl-demo-outer">
                  <!-- #owl-demo -->
                  <div id="owl-demo4" class="deals-wk2">
                    <div class="item">
                      <div class="row">
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_01.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_02.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">
                                $290.00 <span>$350.00</span>
                              </p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_03.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_03.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_01.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_02.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">
                                $290.00 <span>$350.00</span>
                              </p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                      </div>
                    </div>

                    <div class="item">
                      <div class="row">
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_01.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_02.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">
                                $290.00 <span>$350.00</span>
                              </p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_03.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_03.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_01.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">$290.00</p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                        <div class="col-lg-6">
                          <!-- e-product -->
                          <div class="e-product e-product2">
                            <div class="pro-img">
                              <img
                                src="assets/images/01_homepage_v1/best_seller_product_02.jpg"
                                alt="2"
                              />
                            </div>
                            <div class="pro-text-outer">
                              <span
                                >A handful of model sent ence s
                                generate</span
                              >
                              <p class="wk-price">
                                $290.00 <span>$350.00</span>
                              </p>
                            </div>
                          </div>
                          <!-- /e-product -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /purchased product -->
      <!-- /.pro-text -->
    </div>
  </div>
  <!-- /.shop-deails-bg -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row"></div>
      </div>
      <!-- right side -->
    </div>
  </div>
  <!-- /.grid-shop -->
</section>
<!-- /grid-shop -->
@endsection