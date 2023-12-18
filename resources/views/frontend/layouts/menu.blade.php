			<!-- Begin Header Area -->
      <header>
          <!-- Begin Header Top Area -->
          <div class="header-top">
              <div class="container">
                  <div class="row">
                      <!-- Begin Header Top Left Area -->
                      <div class="col-lg-3 col-md-4">
                          <div class="header-top-left">
                              <ul class="phone-wrap">
                                  <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                              </ul>
                          </div>
                      </div>
                      <!-- Header Top Left Area End Here -->
                      <!-- Begin Header Top Right Area -->
                      <div class="col-lg-9 col-md-8">
                          <div class="header-top-right">
                              <ul class="ht-menu">
                                  <!-- Begin Setting Area -->
                                  <li>
                                    @if( auth()->guard('customer')->check() )
                                      <div class="ht-setting-trigger"><span>Setting</span></div>
                                      <div class="setting ht-setting">
                                          <ul class="ht-setting-list">
                                              <li><a href="/profile">My Account</a></li>
                                              <li><a href="/logout">Logout</a></li>
                                          </ul>
                                      </div>
                                    @else
                                      <div class=""><span><a href="/customer/login">Sign In</a></span></div>
                                    @endif
                                  </li>
                                  <!-- Setting Area End Here -->
                                  <!-- Begin Currency Area -->
                                  <!-- <li>
                                      <span class="currency-selector-wrapper">Currency :</span>
                                      <div class="ht-currency-trigger"><span>USD $</span></div>
                                      <div class="currency ht-currency">
                                          <ul class="ht-setting-list">
                                              <li><a href="#">EUR €</a></li>
                                              <li class="active"><a href="#">USD $</a></li>
                                          </ul>
                                      </div>
                                  </li> -->
                                  <!-- Currency Area End Here -->
                                  <!-- Begin Language Area -->
                                  <!-- <li>
                                      <span class="language-selector-wrapper">Language :</span>
                                      <div class="ht-language-trigger"><span>English</span></div>
                                      <div class="language ht-language">
                                          <ul class="ht-setting-list">
                                              <li class="active"><a href="#"><img src="{{asset('frontend/images/menu/flag-icon/1.jpg')}}" alt="">English</a></li>
                                              <li><a href="#"><img src="{{asset('frontend/images/menu/flag-icon/2.jpg')}}" alt="">Français</a></li>
                                          </ul>
                                      </div>
                                  </li> -->
                                  <!-- Language Area End Here -->
                              </ul>
                          </div>
                      </div>
                      <!-- Header Top Right Area End Here -->
                  </div>
              </div>
          </div>
          <!-- Header Top Area End Here -->
          <!-- Begin Header Middle Area -->
          <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
              <div class="container">
                  <div class="row">
                      <!-- Begin Header Logo Area -->
                      <div class="col-lg-3">
                          <div class="logo pb-sm-30 pb-xs-30">
                              <a href="index.html">
                                  <img src="{{asset('frontend/images/menu/logo/1.jpg')}}" alt="">
                              </a>
                          </div>
                      </div>
                      <!-- Header Logo Area End Here -->
                      <!-- Begin Header Middle Right Area -->
                      <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                          <!-- Begin Header Middle Searchbox Area -->
                          <form action="{{ url('product_list') }}" method="GET" class="hm-searchbox">
                              <input type="text" name="q" placeholder="Enter your search key ...">
                              <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                          <!-- Header Middle Searchbox Area End Here -->
                          <!-- Begin Header Middle Right Area -->
                          <div class="header-middle-right">
                              <ul class="hm-menu">
                                  <!-- Begin Header Middle Wishlist Area -->
                                  <li class="hm-wishlist">
                                      <a href="/wishlist">
                                          <span class="cart-item-count wishlist-item-count">{{Cart::instance('wishlist')->count()}}</span>
                                          <i class="fa fa-heart-o"></i>
                                      </a>
                                  </li>
                                  <!-- Header Middle Wishlist Area End Here -->
                                  <!-- Begin Header Mini Cart Area -->
                                  <li class="hm-minicart">
                                      <div class="hm-minicart-trigger">
                                          <span class="item-icon"></span>
                                          <span class="item-text">{{Cart::instance('shopping')->total()}}
                                              <span class="cart-item-count">{{Cart::instance('shopping')->count()}}</span>
                                          </span>
                                      </div>
                                      <span></span>
                                      @if(Cart::instance('shopping')->count() > 0)
                                      <div class="minicart">
                                          <ul class="minicart-product-list">
                                          	@foreach(Cart::instance('shopping')->content() as $item)
                                              <li>
                                                  <a href="/detail" class="minicart-product-image">
                                                      <img src="{{ productImage($item->model->image) }}" alt="cart products">
                                                  </a>
                                                  <div class="minicart-product-details">
                                                      <h6><a href="/detail">{{$item->model->name}}</a></h6>
                                                      <span>{{$item->model->price}} x {{$item->qty}}</span>
                                                  </div>
                                                  <button class="close" title="Remove">
                                                      <i class="fa fa-close"></i>
                                                  </button>
                                              </li>
                                             @endforeach
                                          </ul>
                                          <p class="minicart-total">SUBTOTAL: <span>{{Cart::instance('shopping')->total()}}</span></p>
                                          <div class="minicart-button">
                                              <a href="/cart" class="li-button li-button-fullwidth li-button-dark">
                                                  <span>View Full Cart</span>
                                              </a>
                                              <a href="/checkout" class="li-button li-button-fullwidth">
                                                  <span>Checkout</span>
                                              </a>
                                          </div>
                                      </div>
                                      @endif
                                  </li>
                                  <!-- Header Mini Cart Area End Here -->
                              </ul>
                          </div>
                          <!-- Header Middle Right Area End Here -->
                      </div>
                      <!-- Header Middle Right Area End Here -->
                  </div>
              </div>
          </div>
          <!-- Header Middle Area End Here -->
          <!-- Begin Header Bottom Area -->
          <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <!-- Begin Header Bottom Menu Area -->
                          <div class="hb-menu">
                              <nav>
                                  <ul>
                                      <li><a href="/">Home</a></li>
                                      <li class="megamenu-holder"><a href="/product_list">Shop</a>
                                          <ul class="megamenu hb-megamenu">
                                              <li><a href="/product_list">Shop Page Layout</a>
                                                  <ul>
                                                      <li><a href="/product_list">Shop 3 Column</a></li>
                                                      <li><a href="/product_list">Shop 4 Column</a></li>
                                                      <li><a href="/product_list">Shop Left Sidebar</a></li>
                                                      <li><a href="/product_list">Shop Right Sidebar</a></li>
                                                      <li><a href="/product_list">Shop List</a></li>
                                                      <li><a href="/product_list">Shop List Left Sidebar</a></li>
                                                      <li><a href="/product_list">Shop List Right Sidebar</a></li>
                                                  </ul>
                                              </li>
                                              <li><a href="/product_list">Single Product Style</a>
                                                  <ul>
                                                      <li><a href="/product_list">Single Product Carousel</a></li>
                                                      <li><a href="/product_list">Single Product Gallery Left</a></li>
                                                      <li><a href="/product_list">Single Product Gallery Right</a></li>
                                                      <li><a href="/product_list">Single Product Tab Style Top</a></li>
                                                      <li><a href="/product_list">Single Product Tab Style Left</a></li>
                                                      <li><a href="/product_list">Single Product Tab Style Right</a></li>
                                                  </ul>
                                              </li>
                                              <li><a href="/detail">Single Products</a>
                                                  <ul>
                                                      <li><a href="/detail">Single Product</a></li>
                                                      <li><a href="/product_list">Single Product Sale</a></li>
                                                      <li><a href="/product_list">Single Product Group</a></li>
                                                      <li><a href="/product_list">Single Product Normal</a></li>
                                                      <li><a href="/product_list">Single Product Affiliate</a></li>
                                                  </ul>
                                              </li>
                                          </ul>
                                      </li>
                                      <li><a href="/contact">Contact</a></li>
                                  </ul>
                              </nav>
                          </div>
                          <!-- Header Bottom Menu Area End Here -->
                      </div>
                  </div>
              </div>
          </div>
          <!-- Header Bottom Area End Here -->
          <!-- Begin Mobile Menu Area -->
          <div class="mobile-menu-area d-lg-none d-xl-none col-12">
              <div class="container"> 
                  <div class="row">
                      <div class="mobile-menu">
                      </div>
                  </div>
              </div>
          </div>
          <!-- Mobile Menu Area End Here -->
      </header>
      <!-- Header Area End Here -->