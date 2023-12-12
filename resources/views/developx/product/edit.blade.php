@extends('navMainLayout')

@section('title', ' Product Edit')

@section('vendor-style')
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/> -->
  <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Product /</span> Edit</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('product.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Edit Product</h5>

      <hr class="my-0">
      <div class="card-body">
        <form method="post" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="category_id">Category</label>
            <div class="col-sm-10">
              <select id="category_id" name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $cate)
                  @if($product->category_id == $cate->id)
                    <option value="{{ $cate->id }}" selected>{{ $cate->name }}</option>
                  @else
                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                  @endif
                @endforeach                 
              </select>
              @error('category_id')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $product->name }}"/>
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="slug">Slug</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="slug" id="slug" placeholder="5" value="{{ $product->slug }}" readonly />
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sku">SKU</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU" value="{{ $product->sku }}"/>
              @error('sku')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="price">Price</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="price" id="price" placeholder="10" value="{{ $product->price }}" />
              @error('price')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="details">Short Description</label>
            <div class="col-sm-10">
              <textarea id="details" name="details" class="form-control" placeholder="Write the product short description here" >{{ $product->details }}</textarea>
              @error('details')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="description">Description</label>
            <div class="col-sm-10">
              <textarea id="description" name="description" class="form-control" placeholder="Write the product description here" >{{ $product->description }}</textarea>
              @error('description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="image">Image</label>
            <div class="col-sm-10">
              <input class="form-control" type="file" id="image" name="image">
              @error('image')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="quantity">Quantity</label>
            <div class="col-sm-10">
              <input type="text" id="quantity" class="form-control" placeholder="10" name="quantity" value="{{ $product->quantity }}"/>
            </div>
          </div>          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="featured">Featured</label>
            <div class="col-sm-10">
                <select id="featured" name="featured" class="form-select">
                  <option value="0" {{ ($product->featured == 0) ? "selected" : "" ; }}>No</option>
                  <option value="1" {{ ($product->featured == 1) ? "selected" : "" ; }}>Yes</option>                  
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
    </div>
  </div>

</div>
@endsection

@section('page-script')

@endsection