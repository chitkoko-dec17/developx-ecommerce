@extends('frontendLayout')

@section('layoutContent')
  <!-- Begin Body Wrapper -->
  <div class="body-wrapper">
      @include('frontend/layouts/menu')
      <!-- Begin Li's Breadcrumb Area -->
      <div class="breadcrumb-area">
          <div class="container">
              <div class="breadcrumb-content">
                  <ul>
                      <li><a href="/">Home</a></li>
                      <li class="active">Checkout</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- Li's Breadcrumb Area End Here -->

      {{-- success error msg start --}}
      @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{session()->get('success_message')}}
        </div>
      @endif

      @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
      @endif
      {{-- success error msg end --}}
      <hr>
      
      <!--Checkout Area Strat-->
      <div class="checkout-area pt-60 pb-30">
          <div class="container">
              @if( !auth()->guard('customer')->check() )
              <div class="row">
                  <div class="col-12">
                      <div class="coupon-accordion">
                          <!--Accordion Start-->
                          <h3>Returning customer? <a href="/customer/login">Click here to login</a></h3>
                      </div>
                  </div>
              </div>
              @endif
              <div class="row">
                  <div class="col-lg-6 col-12">
                      <form action="{{route('checkout.store')}}" method="post">
                        @csrf
                          <div class="checkbox-form">
                              <h3>Billing Details</h3>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="checkout-form-list">
                                          <label>First Name <span class="required">*</span></label>
                                          <input placeholder="" name="billing_first_name" type="text" value="{{old('billing_first_name', $last_order->billing_first_name)}}">
                                          @error('billing_first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="checkout-form-list">
                                          <label>Last Name <span class="required">*</span></label>
                                          <input placeholder="" name="billing_last_name" type="text" value="{{old('billing_last_name', $last_order->billing_last_name)}}">
                                          @error('billing_last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="checkout-form-list">
                                          <label>Company Name</label>
                                          <input placeholder="" name="billing_company_name" type="text" value="{{old('billing_company_name', $last_order->billing_company_name)}}">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="checkout-form-list">
                                          <label>Address <span class="required">*</span></label>
                                          <input placeholder="Street address" name="billing_address" type="text" value="{{old('billing_address', $last_order->billing_address)}}">
                                          @error('billing_address')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="checkout-form-list">
                                          <input placeholder="Apartment, suite, unit etc. (optional)" name="billing_address_2" type="text" value="{{old('billing_address_2', $last_order->billing_address_2)}}">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="checkout-form-list">
                                          <label>Town / City <span class="required">*</span></label>
                                          <input type="text" name="billing_city" value="{{old('billing_city', $last_order->billing_city)}}">
                                          @error('billing_city')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="checkout-form-list">
                                          <label>State <span class="required">*</span></label>
                                          <input placeholder="" type="text" name="billing_province" value="{{old('billing_province', $last_order->billing_province)}}">
                                          @error('billing_province')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="checkout-form-list">
                                          <label>Postcode / Zip <span class="required">*</span></label>
                                          <input placeholder="" type="text" name="billing_postalcode" value="{{old('billing_postalcode', $last_order->billing_postalcode)}}">
                                          @error('billing_postalcode')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="country-select clearfix">
                                          <label>Country <span class="required">*</span></label>
                                          <select class="nice-select wide" name="billing_country">
                                            @foreach(countries() as $ckey => $country)
                                              @if($ckey == $last_order->billing_country)
                                                <option value="{{$ckey}}" data-display="{{$country}}" selected>{{$country}}</option>
                                              @else
                                                <option value="{{$ckey}}" data-display="{{$country}}">{{$country}}</option>
                                              @endif
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="checkout-form-list">
                                          <label>Email Address <span class="required">*</span></label>
                                          <input placeholder="" type="email" name="billing_email" value="{{old('billing_email', $last_order->billing_email)}}">
                                          @error('billing_email')
                                            <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="checkout-form-list">
                                          <label>Phone </label>
                                          <input type="text" name="billing_phone" value="{{old('billing_phone', $last_order->billing_phone)}}">
                                      </div>
                                  </div>
                              </div>
                              <div class="different-address">
                                  <div class="ship-different-title">
                                      <h3>
                                          <label>Ship to a different address?</label>
                                          <input id="ship-box" name="different_address" type="checkbox">
                                      </h3>
                                  </div>
                                  <div id="ship-box-info" class="row">
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>First Name <span class="required">*</span></label>
                                              <input placeholder="" name="shipping_first_name" type="text" value="{{old('shipping_first_name', $last_order->shipping_first_name)}}">
                                              @error('shipping_first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Last Name <span class="required">*</span></label>
                                              <input placeholder="" name="shipping_last_name" type="text" value="{{old('shipping_last_name', $last_order->shipping_last_name)}}">
                                              @error('shipping_last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Company Name</label>
                                              <input placeholder="" name="shipping_company_name" type="text" value="{{old('shipping_company_name', $last_order->shipping_company_name)}}">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Address <span class="required">*</span></label>
                                              <input placeholder="Street address" name="shipping_address" type="text" value="{{old('shipping_address', $last_order->shipping_address)}}">
                                              @error('shipping_address')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <input placeholder="Apartment, suite, unit etc. (optional)" name="shipping_address_2" type="text" value="{{old('shipping_address_2', $last_order->shipping_address_2)}}">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Town / City <span class="required">*</span></label>
                                              <input type="text" name="shipping_city" value="{{old('shipping_city', $last_order->shipping_city)}}">
                                              @error('shipping_city')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>State <span class="required">*</span></label>
                                              <input placeholder="" type="text" name="shipping_province" value="{{old('shipping_province', $last_order->shipping_province)}}">
                                              @error('shipping_province')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Postcode / Zip <span class="required">*</span></label>
                                              <input placeholder="" type="text" name="shipping_postalcode" value="{{old('shipping_postalcode', $last_order->shipping_postalcode)}}">
                                              @error('shipping_postalcode')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="country-select clearfix">
                                              <label>Country <span class="required">*</span></label>
                                              <select class="nice-select wide" name="shipping_country">
                                                @foreach(countries() as $ckey => $country)
                                                  @if($ckey == $last_order->shipping_country)
                                                    <option value="{{$ckey}}" data-display="{{$country}}" selected>{{$country}}</option>
                                                  @else
                                                    <option value="{{$ckey}}" data-display="{{$country}}">{{$country}}</option>
                                                  @endif
                                                @endforeach
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Email Address <span class="required">*</span></label>
                                              <input placeholder="" type="email" name="shipping_email" value="{{old('shipping_email', $last_order->shipping_email)}}">
                                              @error('shipping_email')
                                                <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="checkout-form-list">
                                              <label>Phone </label>
                                              <input type="text" name="shipping_phone" value="{{old('shipping_phone', $last_order->shipping_phone)}}">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="order-notes">
                                      <div class="checkout-form-list">
                                          <label>Order Notes</label>
                                          <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." name="order_note">{{old('order_note')}}</textarea>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      
                  </div>
                  <div class="col-lg-6 col-12">
                      <div class="your-order">
                          <h3>Your order</h3>
                          <div class="your-order-table table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th class="cart-product-name">Product</th>
                                          <th class="cart-product-total">Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach(Cart::content() as $item)
                                      <tr class="cart_item">
                                        <td class="cart-product-name"> {{$item->model->name}}<strong class="product-quantity"> × {{$item->qty}}</strong></td>
                                        <td class="cart-product-total"><span class="amount">{{$item->model->price}}</span></td>  
                                      </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot>
                                      <tr class="cart-subtotal">
                                          <th>Cart Subtotal</th>
                                          <td><span class="amount">{{Cart::total()}}</span></td>
                                      </tr>
                                      <tr class="order-total">
                                          <th>Order Total</th>
                                          <td><strong><span class="amount">{{Cart::total()}}</span></strong></td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                          <div class="payment-method">
                              <div class="payment-accordion">
                                  <div id="accordion">
                                    <div class="card">
                                      <div class="card-header" id="#payment-1">
                                        <h5 class="panel-title">
                                          <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Direct Bank Transfer.
                                          </a>
                                        </h5>
                                      </div>
                                      <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                          <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card">
                                      <div class="card-header" id="#payment-2">
                                        <h5 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Cheque Payment
                                          </a>
                                        </h5>
                                      </div>
                                      <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                          <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card">
                                      <div class="card-header" id="#payment-3">
                                        <h5 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            PayPal
                                          </a>
                                        </h5>
                                      </div>
                                      <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                          <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="order-button-payment">
                                      <input value="Place order" type="submit">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </form>
              </div>
          </div>
      </div>
      <!--Checkout Area End-->
      @include('frontend/layouts/footer')
  </div>
  <!-- Body Wrapper End Here -->
@endsection
