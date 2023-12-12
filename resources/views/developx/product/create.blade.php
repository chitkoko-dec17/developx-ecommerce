@extends('navMainLayout')

@section('title', ' Product Create')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Product /</span> Create</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('product.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Create Product</h5>

      <hr class="my-0">
      <div class="card-body">
        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="category_id">Category</label>
            <div class="col-sm-10">
              <select id="category_id" name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $cate)
                  <option value="{{ $cate->id }}">{{ $cate->name }}</option>
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
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sku">SKU</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU" />
              @error('sku')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="price">Price</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="price" id="price" placeholder="10" value="" />
              @error('price')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="details">Short Description</label>
            <div class="col-sm-10">
              <textarea id="details" name="details" class="form-control" placeholder="Write the product short description here" ></textarea>
              @error('details')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="description">Description</label>
            <div class="col-sm-10">
              <textarea id="description" name="description" class="form-control" placeholder="Write the product description here" ></textarea>
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
              <input type="text" id="quantity" class="form-control" placeholder="10" name="quantity" />
            </div>
          </div>          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="featured">Featured</label>
            <div class="col-sm-10">
                <select id="featured" name="featured" class="form-select">
                  <option value="0">No</option>
                  <option value="1">Yes</option>                  
              </select>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
  $('#book-parent-name').hide();
  $("#book_level").on('change', function() {
    console.log($(this).val());
    if ($(this).val() == 'child'){
      $('#book-parent-name').show();
    } else {
      $('#book-parent-name').hide();
    }
});
</script>
@endsection