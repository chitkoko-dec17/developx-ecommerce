@extends('navMainLayout')

@section('title', ' Category Edit')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Category /</span> Edit</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ url('category') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Edit Category</h5>

      <hr class="my-0">
      <div class="card-body">
        <form action="{{ route('category.update',$category->id) }}" method="POST">
        	@csrf
          @method('PUT')
        	<div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="{{ $category->name }}" />
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="slug">Slug</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="slug" id="slug" placeholder="5" value="{{ $category->slug }}" readonly />
            </div>
          </div>

        	<div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        	</div>
        </form>

      </div>
    </div>
  </div>

</div>
@endsection
