@extends('navMainLayout')

@section('title', 'Product List')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold">
		Order 
	</h4>
</div> 
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('export.csv') }}" class="btn btn-primary a_btn_fix" role="button">
		<span class="tf-icons bx bx-book me-1"></span>&nbsp; Export CSV
	</a>
</div>

<div class="col-md-12">
    <div class="card mb-12">
    	<h5 class="card-header">Search</h5>
      
      	<div class="card-body">
	        <form action="" method="GET">
	          	<div class="row">
		            <div class="mb-3 col-md-6">
		              	<input name="q" type="text" class="form-control" placeholder="Enter Customer Name" value="{{ $search }}">
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
  	<h5 class="card-header">Order List </h5>
  	
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
			            <th width="200">Customer Name</th>
			            <th width="280">Order Note</th>
			            <th width="50">Total</th>			            
			            <th width="50">Status</th>
			            <th width="50">Actions</th>
		          	</tr>
		        </thead>
		        <tbody>
		        	@forelse($orders as $order)
		        		@php
		        			$first_name = ($order->customer) ? $order->customer->first_name : "";
		        			$last_name = ($order->customer) ? $order->customer->last_name : "";
		        			$fullname = $first_name .' '. $last_name;
		        		@endphp
		        		<tr>
				            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $fullname }}</strong></td>				       
				            <td>{{ $order->order_note }}</td>				            
				            <td>{{ $order->billing_total }}</td>
				            <td>{{ $order->order_status }}</td>
				            <td>
				            	<div class="d-inline-block text-nowrap">
				            		<a href="{{ route('order.show',$order->id) }}" class="btn btn-sm btn-icon edit-record" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="View" data-bs-original-title="View"><i class="bx bx-show"></i></a>
				            		<a href="{{ route('order.edit',$order->id) }}" class="btn btn-sm btn-icon edit-record" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="View" data-bs-original-title="Edit"><i class="bx bx-edit"></i></a>
				            	</div>
				            </td>
			          	</tr>
		        	@empty
		                <tr>
		                    <td colspan="6">There are no orders.</td>
		                </tr>
		            @endforelse
		        </tbody>
		  	</table>
	    </div>

	    <div class="row">
	      	<div class="col">
		        <div class="demo-inline-spacing">
		          	<!-- Pagination -->
		          	<nav aria-label="Page navigation">
		            {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
		          	</nav>
		          	<!--/ Pagination -->
		        </div>
	      	</div>
	    </div>

  	</div>
</div>
<!--/ Bordered Table -->

<!-- Delete Modal Box -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Delete Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="delete-inv" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <p>Are you sure you want to delete?</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="delete-it" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script type="text/javascript">

	$(document).on('click', '.data_dele_id', function() {
        $('#deleteModal').modal('show');
        let href = $(this).attr('data-attr');
        $('#delete-inv').attr('action', href);
    });
</script>
@endsection