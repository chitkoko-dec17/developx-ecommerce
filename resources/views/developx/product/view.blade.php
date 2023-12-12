@extends('navMainLayout')

@section('title', ' Product Detail')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Product /</span> Detail</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('product.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Detail Product</h5>

      <hr class="my-0">
      <div class="card-body">
        <div class="row">
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Category</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->category->name }}
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Name</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->name }}
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">SKU</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->sku }}
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Price</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->price }}
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Quantity</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->quantity }}
            </div>
          </div>          
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Featured</label>
            <div class="col-sm-12 col-md-6">
              @if($product->featured == 1) 
              <span class="badge bg-label-primary me-1">Yes</span>
              @else
              <span class="badge bg-label-warning me-1">No</span>
              @endif
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Short Description</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->details }}
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-md-4 col-form-label">Description</label>
            <div class="col-sm-12 col-md-6 data_title">
              {{ $product->description }}
            </div>
          </div>
          <div class="row mb-3 col-md-6">
            <label class="col-sm-12 col-form-label" for="image">Image</label>
            <div class="col-sm-12">
              <img src="{{ url($product->image) }}" class="img-thumbnail">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('page-script')

@endsection