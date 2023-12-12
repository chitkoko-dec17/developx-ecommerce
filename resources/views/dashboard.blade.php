@extends('layout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">

<style type="text/css">
    .card-title .bx{
        font-size: 2.15rem;
        padding: 8px;
    }
    .card-title .fw-semibold{
        font-size: 20px;
        margin-left: 10px;
    }
    h3.card-title{
        text-align: center;
    }
    .text-top{
        margin-top: -5px;
    }
    .text-center{
        margin-top: 12px;
    }
</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  
  <div class="col-lg-12 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start">
                <i class="tf-icons bx bx-book-bookmark btn-primary"></i>
                <span class="fw-semibold d-block mb-1 text-top">This Month Orders</span>
            </div>
            <h3 class="card-title mb-2">{{ $countdata['premium_books'] }}</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start">
                <i class="tf-icons bx bx-book btn-success"></i>
                <span class="fw-semibold d-block mb-1 text-center">Today Orders</span>
            </div>
            <h3 class="card-title text-nowrap mb-1">{{ $countdata['free_books'] }}</h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start">
                <i class="tf-icons bx bxs-user btn-info"></i>
                <span class="fw-semibold d-block mb-1 text-center">Total Users</span>
            </div>
            <h3 class="card-title text-nowrap mb-2">{{ $countdata['total_customers'] }}</h3>
            
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start">
                <i class="tf-icons bx bx-money btn-dark"></i>
                <span class="fw-semibold d-block mb-1 text-top">Transactions (MMK)</span>
            </div>
            <h3 class="card-title mb-2">{{ $countdata['total_sell_amount'] }} </h3>
            
          </div>
        </div>
      </div>

    </div>
  </div>
  
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">

    </div>

    <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">

    </div>

    <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">

    </div>
</div>
@endsection
