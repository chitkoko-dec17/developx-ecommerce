@extends('navMainLayout')

@section('title', ' Category Create')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Category /</span> Create</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('category.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Create Category</h5>

      <hr class="my-0">
      <div class="card-body">
        <form method="post" action="{{ url('category') }}">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" />
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
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
