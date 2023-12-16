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
                      <li class="active">Thank You</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- Li's Breadcrumb Area End Here -->
      
      <!--Checkout Area Strat-->
      <div class="checkout-area pt-60 pb-30">
          <div class="container">
            <div class="row">
              <div class="col-12">
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
              </div>
              <div class="col-lg-3"></div>
              <div class="col-lg-8">
                  <h1>Thank you for Your Order!</h1>
                  <p>A confirmation email was sent</p>
             
              </div>
              <div class="col-lg-1"></div>
            </div>  
         </div>
      </div>
      <!--Checkout Area End-->
      @include('frontend/layouts/footer')
  </div>
  <!-- Body Wrapper End Here -->
@endsection
