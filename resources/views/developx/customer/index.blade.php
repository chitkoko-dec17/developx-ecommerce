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
			            <th width="110">Email</th>
			            <th width="110">Status</th>
			            <th width="120">Actions</th>
		          	</tr>
		        </thead>
		        <tbody>
		        	@forelse($customers as $customer)
		        		@php
		        			$first_name = ($customer->first_name) ? $customer->first_name : "";
		        			$last_name = ($customer->last_name) ? $customer->last_name : "";
		        			$fullname = $first_name .' '. $last_name;
		        		@endphp
		        		<tr>
				            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $fullname }}</strong></td>
				            <td>{{ $customer->phone }}</td>
				            <td>{{ $customer->email }}</td>
				            <td>
				            	@if($customer->status == 'active') 
				            	<span class="badge bg-label-primary me-1">Active</span>
				            	@elseif($customer->status == 'inactive')
				            	<span class="badge bg-label-warning me-1">Inactive</span>
				            	@endif
				            </td>
				            <td>
				            	<div class="d-inline-block text-nowrap">
				            		<a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-sm btn-icon edit-record" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="View" data-bs-original-title="Edit"><i class="bx bx-edit"></i></a>
				            	</div>
				            	<!-- <a class="dropdown-item cust_dele_id" data-id="{{$customer->id}}" href="javascript:void(0)"><i class="bx bx-trash me-1"></i> Delete</a> -->
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