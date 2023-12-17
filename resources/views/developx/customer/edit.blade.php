@extends('navMainLayout')

@section('title', ' Customer Edit')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold"><span class="text-muted fw-light">Customer /</span> Edit</h4>
</div>
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('customer.index') }}" role="button" class="btn btn-icon btn-primary a_btn_fix">
	    <span class="tf-icons bx bxs-left-arrow-circle"></span>
  	</a>
</div>

<div class="row">

  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Edit Customer</h5>

      <hr class="my-0">
      <div class="card-body">
        <form action="{{ route('customer.update',$customer->id) }}" method="POST">
        	@csrf
            @method('PUT')
          	<div class="row mb-3">
	            <label class="col-sm-2 col-form-label" for="name">Name</label>
	            <div class="col-sm-10">
	              <input type="text" class="form-control" id="name" value="{{ $customer->first_name .' '. $customer->last_name}}" readonly />
	            </div>
          	</div>
          	<!-- <div class="row mb-3">
	            <label class="col-sm-2 col-form-label" for="email">Email</label>
	            <div class="col-sm-10">
	              	<input type="text" id="email" class="form-control" placeholder="john.doe" value="{{ $customer->social_email }}" readonly />
	            </div>
          	</div> -->
          	<div class="row mb-3">
	            <label class="col-sm-2 col-form-label" for="phone">Phone No</label>
	            <div class="col-sm-10">
	              <input type="text" name="phone" id="phone" class="form-control phone-mask" placeholder="09658 799 8941" value="{{ $customer->phone }}" aria-describedby="phone" readonly/>
	            </div>
          	</div>
          	
          	<!-- <div class="row mb-3">
	            <label class="col-sm-2 col-form-label" for="social_type">Social Type</label>
	            <div class="col-sm-10">
	              <input type="text" class="form-control" name="social_type" id="social_type" value="{{ $customer->social_type }}" readonly/>
	            </div>
          	</div> -->
          	<div class="row mb-3">
	            <label class="col-sm-2 col-form-label" for="email">Email</label>
	            <div class="col-sm-10">
	              <input type="text" class="form-control" value="{{ $customer->email }}" readonly />
	            </div>
          	</div>
          	<div class="row mb-3">
	            <label class="col-sm-2 col-form-label" for="status">Status</label>
	            <div class="col-sm-10">
	              	<select id="status" name="status" class="form-select">
	              		@if($customer->status == 'active') 
	              			<option value="active" selected>Active</option>
	              			<option value="inactive">Inactive</option>
	              		@elseif($customer->status == 'inactive')
	              			<option value="active">Active</option>
	              			<option value="inactive" selected>Inactive</option>
	              		@endif			            
		          	</select>
	            </div>
          	</div>

          	<div class="row justify-content-end">
	            <div class="col-sm-10">
	              <button type="submit" class="btn btn-primary">Edit</button>
	              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
	            </div>
          	</div>
        </form>

      </div>
    </div>
  </div>


</div>
@endsection
