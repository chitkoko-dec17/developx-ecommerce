@extends('navMainLayout')

@section('title', ' Order Edit')

@section('vendor-style')
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/> -->
  <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Order /</span> Edit</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('order.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Edit Order</h5>

      <hr class="my-0">
      <div class="card-body">
        <div class="row">
          <form method="post" action="{{ route('order.update',$order->id) }}">
            @csrf
            @method('PUT')       
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="order_status">Category</label>
              <div class="col-sm-4">
                <select id="order_status" name="order_status" class="form-select">
                  @foreach($order_statuses as $skey => $status)
                    @if($order->order_status == $skey)
                      <option value="{{ $skey }}" selected>{{ $status }}</option>
                    @else
                      <option value="{{ $skey }}">{{ $status }}</option>
                    @endif
                  @endforeach                 
                </select>
              </div>
            </div>

            <div class="row justify-content-end">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Edit</button>
                <!-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> -->
              </div>
            </div>
          </form>
        </div>
        <br>
        <hr>

        <div class="row">
          <div class="row mb-3 col-md-12">
            <label class="col-sm-12 col-md-2 col-form-label">Customer Info</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $order->customer->first_name .' '.$order->customer->last_name }}
              
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Billing Address</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $order->billing_company_name }}<br/>
              {{ $order->billing_address }}<br/>
              {{ ($order->billing_address_2) ? $order->billing_address_2."<br/>" : "" }}
              {{ $order->billing_province }}<br/>
              {{ $order->billing_city }}<br/>
              {{ $order->billing_postalcode }}<br/>
              {{ $order->billing_country }}<br/>
              {{ $order->billing_email }}<br/>
              {{ $order->billing_phone }}<br/>
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Shipping Address</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ ($order->shipping_company_name) ? $order->shipping_company_name : $order->billing_company_name  }}<br/>
              {{ ($order->shipping_address) ? $order->shipping_address : $order->billing_address }}<br/>
              {{ ($order->shipping_address_2) ? $order->shipping_address_2."<br/>" : "" }}
              {{ ($order->shipping_province) ? $order->shipping_province : $order->billing_province }}<br/>
              {{ ($order->shipping_city) ? $order->shipping_city : $order->billing_city }}<br/>
              {{ ($order->shipping_postalcode) ? $order->shipping_postalcode : $order->billing_postalcode }}<br/>
              {{ ($order->shipping_country) ? $order->shipping_country : $order->billing_country }}<br/>
              {{ ($order->shipping_email) ? $order->shipping_email : $order->billing_email }}<br/>
              {{ ($order->shipping_phone) ? $order->shipping_phone : $order->billing_phone }}<br/>
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Order Status</label>
            <div class="col-sm-12 col-md-6 data_title">
              @if($order->order_status == 'active') 
              <span class="badge bg-label-primary me-1">{{ $order_statuses[$order->order_status] }}</span>
              @elseif($order->order_status == 'pending') 
              <span class="badge bg-label-info me-1">{{ $order_statuses[$order->order_status] }}</span>
              @else
              <span class="badge bg-label-warning me-1">{{ $order_statuses[$order->order_status] }}</span>
              @endif
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Order Date</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ date('d-m-Y', strtotime($order->created_at)) }}
            </div>
          </div>          
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Order Note</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $order->order_note }}
            </div>
          </div>

        </div>

        <div class="row">
          <div class="table-container invoice-table" id="table">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>No.</td>
                        <td class="item">
                            <h6 class="p-2 mb-0">Item</h6>
                        </td>
                        <td class="Hours fixed-column">
                            <h6 class="p-2 mb-0">Quantity</h6>
                        </td>
                        <td class="Rate">
                            <h6 class="p-2 mb-0">Unit Price</h6>
                        </td>
                        <td class="subtotal">
                            <h6 class="p-2 mb-0">Total</h6>
                        </td>
                    </tr>
                    @php
                        $item_no = 1;
                    @endphp
                    @if (count($order->order_products) > 0)
                    @php
                      //var_dump($order->order_products);exit;
                    @endphp
                        @foreach ($order->order_products as $ordpro)
                            <tr>
                                <td>{{ $item_no }}</td>
                                <td>{{ $ordpro->product->name }}</td>
                                <td class="fixed-column">{{ $ordpro->quantity }}</td>
                                <td>{{ $ordpro->product->price }}</td>
                                <td>{{ $ordpro->quantity * $ordpro->product->price }}</td>
                            </tr>
                            @php
                                $item_no++;
                            @endphp
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            Sub Total
                        </td>
                        <td class="payment digits">
                            <h6 class="mb-0 p-2">{{ $order->billing_subtotal }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            Total
                        </td>
                        <td class="payment digits">
                            <h6 class="mb-0 p-2">{{ $order->billing_total }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <!-- End Table-->
        </div>

        


      </div>
    </div>
  </div>

</div>
@endsection

@section('page-script')

@endsection