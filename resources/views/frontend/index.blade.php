@extends('frontendLayout')

@section('layoutContent')
  <!-- Begin Body Wrapper -->
  <div class="body-wrapper">
      @include('frontend/layouts/menu')
      <!-- Begin Slider With Banner Area -->
      <div class="slider-with-banner">
          <div class="container">
              <div class="row">
                  <!-- Begin Slider Area -->
                  <div class="col-lg-8 col-md-8">
                      <div class="slider-area">
                          <div class="slider-active owl-carousel">
                              <!-- Begin Single Slide Area -->
                              <div class="single-slide align-center-left  animation-style-01 bg-1">
                                  <div class="slider-progress"></div>
                                  <div class="slider-content">
                                      <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                      <h2>Chamcham Galaxy S9 | S9+</h2>
                                      <h3>Starting at <span>$1209.00</span></h3>
                                      <div class="default-btn slide-btn">
                                          <a class="links" href="#">Shopping Now</a>
                                      </div>
                                  </div>
                              </div>
                              <!-- Single Slide Area End Here -->
                              <!-- Begin Single Slide Area -->
                              <div class="single-slide align-center-left animation-style-02 bg-2">
                                  <div class="slider-progress"></div>
                                  <div class="slider-content">
                                      <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                      <h2>Work Desk Surface Studio 2018</h2>
                                      <h3>Starting at <span>$824.00</span></h3>
                                      <div class="default-btn slide-btn">
                                          <a class="links" href="#">Shopping Now</a>
                                      </div>
                                  </div>
                              </div>
                              <!-- Single Slide Area End Here -->
                              <!-- Begin Single Slide Area -->
                              <div class="single-slide align-center-left animation-style-01 bg-3">
                                  <div class="slider-progress"></div>
                                  <div class="slider-content">
                                      <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                      <h2>Phantom 4 Pro+ Obsidian</h2>
                                      <h3>Starting at <span>$1849.00</span></h3>
                                      <div class="default-btn slide-btn">
                                          <a class="links" href="#">Shopping Now</a>
                                      </div>
                                  </div>
                              </div>
                              <!-- Single Slide Area End Here -->
                          </div>
                      </div>
                  </div>
                  <!-- Slider Area End Here -->
                  <!-- Begin Li Banner Area -->
                  <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                      <div class="li-banner">
                          <a href="#">
                              <img src="{{asset('frontend/images/banner/1_1.jpg')}}" alt="">
                          </a>
                      </div>
                      <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                          <a href="#">
                              <img src="{{asset('frontend/images/banner/1_2.jpg')}}" alt="">
                          </a>
                      </div>
                  </div>
                  <!-- Li Banner Area End Here -->
              </div>
          </div>
      </div>
      <!-- Slider With Banner Area End Here -->
      <!-- Begin Product Area -->
      <div class="product-area pt-60 pb-50">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="li-product-tab">
                          <ul class="nav li-product-menu">
                             <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li>
                             <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bestseller</span></a></li>
                             <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li>
                          </ul>               
                      </div>
                      <!-- Begin Li's Tab Menu Content Area -->
                  </div>
              </div>
              <div class="tab-content">
                  <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                      <div class="row">
                          <div class="product-active owl-carousel">
                              @foreach($data['new_arrival'] as $newarrival)
                              <div class="col-lg-12">
                                  <!-- single-product-wrap start -->
                                  <div class="single-product-wrap">
                                      <div class="product-image">
                                          <a href="{{ route('detail', $newarrival->slug) }}">
                                              <img src="{{ productImage($newarrival->image) }}" alt="{{ $newarrival->name }}">
                                          </a>
                                          <span class="sticker">New</span>
                                      </div>
                                      <div class="product_desc">
                                          <div class="product_desc_info">
                                              <div class="product-review">
                                                  <h5 class="manufacturer">
                                                      <a href="#">{{ $newarrival->category->name }}</a>
                                                  </h5>
                                                  <div class="rating-box">
                                                      <ul class="rating">
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <h4><a class="product_name" href="{{ route('detail', $newarrival->slug) }}">{{ $newarrival->name }}</a></h4>
                                              <div class="price-box">
                                                  <span class="new-price">${{ $newarrival->price }}</span>
                                              </div>
                                          </div>
                                          <div class="add-actions">
                                              <ul class="add-actions-link">
                                                  @if ($newarrival->quantity > 0)
                                                    <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $newarrival) }}" href="javascript:void(0)">Add to cart</a></li>
                                                  @endif
                                                  <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $newarrival) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                  <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- single-product-wrap end -->
                              </div>
                              @endforeach
                              
                          </div>
                      </div>
                  </div>
                  <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                      <div class="row">
                          <div class="product-active owl-carousel">
                              @foreach($data['best_seller'] as $bestseller)
                              <div class="col-lg-12">
                                  <!-- single-product-wrap start -->
                                  <div class="single-product-wrap">
                                      <div class="product-image">
                                          <a href="{{ route('detail', $bestseller->slug) }}">
                                              <img src="{{ productImage($bestseller->image) }}" alt="{{ $bestseller->name }}">
                                          </a>
                                          <span class="sticker">New</span>
                                      </div>
                                      <div class="product_desc">
                                          <div class="product_desc_info">
                                              <div class="product-review">
                                                  <h5 class="manufacturer">
                                                      <a href="#">{{ $bestseller->category->name }}</a>
                                                  </h5>
                                                  <div class="rating-box">
                                                      <ul class="rating">
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <h4><a class="product_name" href="{{ route('detail', $bestseller->slug) }}">{{ $bestseller->name }}</a></h4>
                                              <div class="price-box">
                                                  <span class="new-price">${{ $bestseller->price }}</span>
                                              </div>
                                          </div>
                                          <div class="add-actions">
                                              <ul class="add-actions-link">
                                                  @if ($bestseller->quantity > 0)
                                                    <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $bestseller) }}">Add to cart</a></li>
                                                  @endif
                                                  <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $bestseller) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                  <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- single-product-wrap end -->
                              </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
                  <div id="li-featured-product" class="tab-pane" role="tabpanel">
                      <div class="row">
                          <div class="product-active owl-carousel">
                              @foreach($data['featured'] as $featurep)
                              <div class="col-lg-12">
                                  <!-- single-product-wrap start -->
                                  <div class="single-product-wrap">
                                      <div class="product-image">
                                          <a href="{{ route('detail', $featurep->slug) }}">
                                              <img src="{{ productImage($featurep->image) }}" alt="{{ $featurep->name }}">
                                          </a>
                                          <span class="sticker">New</span>
                                      </div>
                                      <div class="product_desc">
                                          <div class="product_desc_info">
                                              <div class="product-review">
                                                  <h5 class="manufacturer">
                                                      <a href="#">{{ $featurep->category->name }}</a>
                                                  </h5>
                                                  <div class="rating-box">
                                                      <ul class="rating">
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <h4><a class="product_name" href="{{ route('detail', $featurep->slug) }}">{{ $featurep->name }}</a></h4>
                                              <div class="price-box">
                                                  <span class="new-price">${{ $featurep->price }}</span>
                                              </div>
                                          </div>
                                          <div class="add-actions">
                                              <ul class="add-actions-link">
                                                  @if ($featurep->quantity > 0)
                                                    <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $featurep) }}">Add to cart</a></li>
                                                  @endif
                                                  <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $featurep) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                  <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- single-product-wrap end -->
                              </div>
                              @endforeach

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Product Area End Here -->
      <!-- Begin Li's Static Banner Area -->
      <div class="li-static-banner">
          <div class="container">
              <div class="row">
                  <!-- Begin Single Banner Area -->
                  <div class="col-lg-4 col-md-4 text-center">
                      <div class="single-banner">
                          <a href="#">
                              <img src="{{asset('frontend/images/banner/1_3.jpg')}}" alt="Li's Static Banner">
                          </a>
                      </div>
                  </div>
                  <!-- Single Banner Area End Here -->
                  <!-- Begin Single Banner Area -->
                  <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                      <div class="single-banner">
                          <a href="#">
                              <img src="{{asset('frontend/images/banner/1_4.jpg')}}" alt="Li's Static Banner">
                          </a>
                      </div>
                  </div>
                  <!-- Single Banner Area End Here -->
                  <!-- Begin Single Banner Area -->
                  <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                      <div class="single-banner">
                          <a href="#">
                              <img src="{{asset('frontend/images/banner/1_5.jpg')}}" alt="Li's Static Banner">
                          </a>
                      </div>
                  </div>
                  <!-- Single Banner Area End Here -->
              </div>
          </div>
      </div>
      <!-- Li's Static Banner Area End Here -->

      <!-- Begin Li's Trending Product Area -->
      <section class="product-area li-trending-product pt-60 pb-45">
          <div class="container">
              <div class="row">
                  <!-- Begin Li's Tab Menu Area -->
                  <div class="col-lg-12">
                      <div class="li-product-tab li-trending-product-tab">
                          <h2>
                              <span>Trendding Products</span>
                          </h2>
                          <ul class="nav li-product-menu li-trending-product-menu">
                             <li><a class="active" data-toggle="tab" href="#home1"><span>Sanai</span></a></li>
                             <li><a data-toggle="tab" href="#home2"><span>Camera Accessories</span></a></li>
                             <li><a data-toggle="tab" href="#home3"><span>XailStation</span></a></li>
                          </ul>               
                      </div>
                      <!-- Begin Li's Tab Menu Content Area -->
                      <div class="tab-content li-tab-content li-trending-product-content">
                          <div id="home1" class="tab-pane show fade in active">
                              <div class="row">
                                  <div class="product-active owl-carousel">
                                      @foreach($data['featured'] as $product)
                                      <div class="col-lg-12">
                                          <!-- single-product-wrap start -->
                                          <div class="single-product-wrap">
                                              <div class="product-image">
                                                  <a href="{{ route('detail', $product->slug) }}">
                                                      <img src="{{ productImage($product->image) }}" alt="{{ $product->name }}">
                                                  </a>
                                                  <span class="sticker">New</span>
                                              </div>
                                              <div class="product_desc">
                                                  <div class="product_desc_info">
                                                      <div class="product-review">
                                                          <h5 class="manufacturer">
                                                              <a href="#">{{ $product->category->name }}</a>
                                                          </h5>
                                                          <div class="rating-box">
                                                              <ul class="rating">
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                      <h4><a class="product_name" href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a></h4>
                                                      <div class="price-box">
                                                          <span class="new-price">${{ $product->price }}</span>
                                                      </div>
                                                  </div>
                                                  <div class="add-actions">
                                                      <ul class="add-actions-link">
                                                          @if ($product->quantity > 0)
                                                            <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $product) }}">Add to cart</a></li>
                                                          @endif
                                                          <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $product) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                          <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- single-product-wrap end -->
                                      </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                          <div id="home2" class="tab-pane fade">
                              <div class="row">
                                  <div class="product-active owl-carousel">
                                      @foreach($data['best_seller'] as $product)
                                      <div class="col-lg-12">
                                          <!-- single-product-wrap start -->
                                          <div class="single-product-wrap">
                                              <div class="product-image">
                                                  <a href="{{ route('detail', $product->slug) }}">
                                                      <img src="{{ productImage($product->image) }}" alt="{{ $product->name }}">
                                                  </a>
                                                  <span class="sticker">New</span>
                                              </div>
                                              <div class="product_desc">
                                                  <div class="product_desc_info">
                                                      <div class="product-review">
                                                          <h5 class="manufacturer">
                                                              <a href="#">{{ $product->category->name }}</a>
                                                          </h5>
                                                          <div class="rating-box">
                                                              <ul class="rating">
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                      <h4><a class="product_name" href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a></h4>
                                                      <div class="price-box">
                                                          <span class="new-price">${{ $product->price }}</span>
                                                      </div>
                                                  </div>
                                                  <div class="add-actions">
                                                      <ul class="add-actions-link">
                                                          @if ($product->quantity > 0)
                                                            <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $product) }}">Add to cart</a></li>
                                                          @endif
                                                          <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $product) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                          <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- single-product-wrap end -->
                                      </div>
                                      @endforeach

                                  </div>
                              </div>
                          </div>
                          <div id="home3" class="tab-pane fade">
                              <div class="row">
                                  <div class="product-active owl-carousel">
                                      @foreach($data['new_arrival'] as $product)
                                      <div class="col-lg-12">
                                          <!-- single-product-wrap start -->
                                          <div class="single-product-wrap">
                                              <div class="product-image">
                                                  <a href="{{ route('detail', $product->slug) }}">
                                                      <img src="{{ productImage($product->image) }}" alt="{{ $product->name }}">
                                                  </a>
                                                  <span class="sticker">New</span>
                                              </div>
                                              <div class="product_desc">
                                                  <div class="product_desc_info">
                                                      <div class="product-review">
                                                          <h5 class="manufacturer">
                                                              <a href="#">{{ $product->category->name }}</a>
                                                          </h5>
                                                          <div class="rating-box">
                                                              <ul class="rating">
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li><i class="fa fa-star-o"></i></li>
                                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                  <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                      <h4><a class="product_name" href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a></h4>
                                                      <div class="price-box">
                                                          <span class="new-price">${{ $product->price }}</span>
                                                      </div>
                                                  </div>
                                                  <div class="add-actions">
                                                      <ul class="add-actions-link">
                                                          @if ($product->quantity > 0)
                                                            <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $product) }}">Add to cart</a></li>
                                                          @endif
                                                          <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $product) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                          <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- single-product-wrap end -->
                                      </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Tab Menu Content Area End Here -->
                  </div>
                  <!-- Tab Menu Area End Here -->
              </div>
          </div>
      </section>
      <!-- Li's Trending Product Area End Here -->
      <!-- Begin Li's Trendding Products Area -->
      <section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
          <div class="container">
              <div class="row">
                  <!-- Begin Li's Section Area -->
                  <div class="col-lg-12">
                      <div class="li-section-title">
                          <h2>
                              <span>Bestsellers</span>
                          </h2>
                      </div>
                      <div class="row">
                          <div class="product-active owl-carousel">
                              @foreach($data['best_seller'] as $product)
                              <div class="col-lg-12">
                                  <!-- single-product-wrap start -->
                                  <div class="single-product-wrap">
                                      <div class="product-image">
                                          <a href="{{ route('detail', $product->slug) }}">
                                              <img src="{{ productImage($product->image) }}" alt="{{ $product->name }}">
                                          </a>
                                          <span class="sticker">New</span>
                                      </div>
                                      <div class="product_desc">
                                          <div class="product_desc_info">
                                              <div class="product-review">
                                                  <h5 class="manufacturer">
                                                      <a href="#">{{ $product->category->name }}</a>
                                                  </h5>
                                                  <div class="rating-box">
                                                      <ul class="rating">
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <h4><a class="product_name" href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a></h4>
                                              <div class="price-box">
                                                  <span class="new-price">${{ $product->price }}</span>
                                              </div>
                                          </div>
                                          <div class="add-actions">
                                              <ul class="add-actions-link">
                                                  @if ($product->quantity > 0)
                                                    <li class="add-cart active"><a class="add-to-card" data-id="{{ route('cart.store', $product) }}">Add to cart</a></li>
                                                  @endif
                                                  <li><a class="links-details add-to-wishlist" data-id="{{ route('wishlist.store', $product) }}" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></li>
                                                  <!-- <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li> -->
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- single-product-wrap end -->
                              </div>
                              @endforeach

                          </div>
                      </div>
                  </div>
                  <!-- Li's Section Area End Here -->
              </div>
          </div>
      </section>
      <!-- Li's Trendding Products Area End Here -->
        
      
      @include('frontend/layouts/footer')
      @include('frontend/layouts/product-quick-view')
      
  </div>
@endsection