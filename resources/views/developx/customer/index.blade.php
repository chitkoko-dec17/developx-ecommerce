@extends('navMainLayout')

@section('title', 'Customer List')

@section('content')
<!-- <div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold">
		Customer 
	</h4>
</div> 
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('customer.create') }}" class="btn btn-primary a_btn_fix" role="button">
		<span class="tf-icons bx bx-user me-1"></span>&nbsp; Create
	</a>
</div> -->
<h4 class="fw-bold py-3">
	Customer 
</h4>

<div class="col-md-12">
    <div class="card mb-12">
    	<h5 class="card-header">Search</h5>
      
      	<div class="card-body">
	        <form action="" method="GET">
	          	<div class="row">
		            <div class="mb-3 col-md-6">
		              	<input name="q" type="text" class="form-control" placeholder="Enter Customer Name or Phone" value="{{ $search }}">
		            </div>
		            <div class="mb-3 col-md-6">
			         	<button type="submit" class="btn btn-primary me-2">Search</button>
		            </div>
	          	</div>
	        </form>
      	</div>
    </div>
</div>
<br>
<div class="card">
  	<h5 class="card-header">Customer List </h5>
  	
  	<div class="card-body">
	  	@if ($message = Session::get('success'))
	        <div class="alert alert-success" role="alert">
	            <p>{{ $message }}</p>
	        </div>
	    @endif

	    <div class="table-responsive text-nowrap">
		  	<table class="table table-bordered">
		        <thead>
		          	<tr>
			            <th>Name</th>
			            <th>Phone</th>
			            <th width="110">Coin</th>
			            <th width="110">Status</th>
			            <th width="120">Actions</th>
		          	</tr>
		        </thead>
		        <tbody>
		        	@forelse($customers as $customer)
		        		<tr>
				            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $customer->name }}</strong></td>
				            <td>{{ $customer->phone }}</td>
				            <td>{{ $customer->total_coin }}</td>
				            <td>
				            	@if($customer->status == 'active') 
				            	<span class="badge bg-label-primary me-1">Active</span>
				            	@elseif($customer->status == 'inactive')
				            	<span class="badge bg-label-warning me-1">Inactive</span>
				            	@endif
				            </td>
				            <td>
				              	<div class="dropdown">
					                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
					                <div class="dropdown-menu">
					                  	<a class="dropdown-item" href="{{ route('customer.edit',$customer->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
					                  	<a class="dropdown-item cust_dele_id" data-id="{{$customer->id}}" href="javascript:void(0)"><i class="bx bx-trash me-1"></i> Delete</a>
					                </div>
				              	</div>
				            </td>
			          	</tr>
		        	@empty
		                <tr>
		                    <td colspan="5">There are no customers.</td>
		                </tr>
		            @endforelse
		        </tbody>
		  	</table>

	      	<form name="customer-delete" method="post" action="">
	      		@csrf
				@method('DELETE')
	      	</form>

	    </div>

	    <div class="row">
	      	<div class="col">
		        <div class="demo-inline-spacing">
		          	<!-- Pagination -->
		          	<nav aria-label="Page navigation">
		            {!! $customers->withQueryString()->links('pagination::bootstrap-5') !!}
		          	</nav>
		          	<!--/ Pagination -->
		        </div>
	      	</div>
	    </div>

  	</div>
</div>
<!--/ Bordered Table -->

@endsection

@section('page-script')
<script type="text/javascript">

	$('.cust_dele_id').click(function(){
		let delete_id = $(this).data("id");
	  	$('form[name=customer-delete]').attr('action','customer/'+delete_id);
	  	$('form[name=customer-delete]').submit();
	});
</script>
@endsection