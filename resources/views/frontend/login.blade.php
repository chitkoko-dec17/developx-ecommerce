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
                      <li class="active">Login Register</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- Li's Breadcrumb Area End Here -->
      <!-- Begin Login Content Area -->
      <div class="page-section mb-60">
          <div class="container">
              <div class="row">
                  <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                      <!-- Login Form s-->
                      <form action="{{ route('customer.add') }}" method="post">
                        @csrf
                          <div class="login-form">
                              <h4 class="login-title">Login</h4>
                              <div class="row">
                                  <div class="col-md-12 col-12 mb-20">
                                      <label>Email Address*</label>
                                      <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                      @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-20">
                                      <label>Password*</label>
                                      <input class="mb-0" type="password" name="password" placeholder="Password">
                                      @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-md-8">
                                      <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                          <input type="checkbox" id="remember_me">
                                          <label for="remember_me">Remember me</label>
                                      </div>
                                  </div>
                                  <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                      <a href="#"> Forgotten pasward?</a>
                                  </div>
                                  <div class="col-md-12">
                                      <button type="submit" class="register-button mt-0">Login</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">

                      <form action="{{ route('customer.register') }}" method="post">
                        @csrf
                          <div class="login-form">
                              <h4 class="login-title">Register</h4>
                              <div class="row">
                                  <div class="col-md-6 col-12 mb-20">
                                      <label for="first_name">First Name</label>
                                      <input class="mb-0" type="text" name="first_name" placeholder="First Name">
                                      @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-md-6 col-12 mb-20">
                                      <label for="last_name">Last Name</label>
                                      <input class="mb-0" type="text" name="last_name" placeholder="Last Name">
                                  </div>
                                  <div class="col-md-12 mb-20">
                                      <label for="email">Email Address*</label>
                                      <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                      @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-md-6 mb-20">
                                      <label for="password">Password</label>
                                      <input class="mb-0" type="password" name="password" placeholder="Password">
                                      @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-md-6 mb-20">
                                      <label for="password_confirmation">Confirm Password</label>
                                      <input class="mb-0" type="password" name="password_confirmation" placeholder="Confirm Password">
                                      @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <button type="submit" class="register-button mt-0">Register</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- Login Content Area End Here -->
      @include('frontend/layouts/footer')
  </div>
  <!-- Body Wrapper End Here -->
@endsection
        
