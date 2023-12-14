@extends('navMainLayout')

@section('title', ' Product Inventory Add')

@section('vendor-style')
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/> -->
  <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Product Inventory /</span> Add</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('product-inventory.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Add Product Inventory</h5>

      <hr class="my-0">
      <div class="card-body">
        <form method="post" action="{{ route('product-inventory.update',$product->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $product->name }}" readonly />
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sku">SKU</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU" value="{{ $product->sku }}" readonly />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="quantity">Quantity</label>
            <div class="col-sm-10">
              <input type="text" id="quantity" class="form-control" placeholder="10" name="quantity" value=""/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="description">Description</label>
            <div class="col-sm-10">
              <textarea id="description" name="description" class="form-control" placeholder="Write inventory description here" ></textarea>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection
