@extends('navMainLayout')

@section('title', 'Inventory List')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold">
		Inventory 
	</h4>
</div> 

<div class="col-md-12">
    <div class="card mb-12">
    	<h5 class="card-header">Search</h5>
      
      	<div class="card-body">
	        <form action="" method="GET">
	          	<div class="row">
		            <div class="mb-3 col-md-6">
		              	<input name="q" type="text" class="form-control" placeholder="Enter Product Name or SKU" value="{{ $search }}">
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
  	<h5 class="card-header">Inventory List </h5>
  	
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
			            <th width="280">Name</th>
			            <th width="50">SKU</th>
			            <th width="50">Quantity</th>
			            <th width="50">Actions</th>
		          	</tr>
		        </thead>
		        <tbody>
		        	@forelse($products as $product)
		        		<tr>
				            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $product->name }}</strong></td>
				            <td>{{ $product->sku }}</td>					         
				            <td>{{ $product->quantity }}</td>
				            <td>
				            	<div class="d-inline-block text-nowrap">
				            		<a href="{{ route('product-inventory.edit',$product->id) }}" class="btn btn-sm btn-icon edit-record" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="View" data-bs-original-title="Edit"><i class="bx bx-edit"></i></a>
				            	</div>
				            </td>
			          	</tr>
		        	@empty
		                <tr>
		                    <td colspan="6">There are no products.</td>
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
		            {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
		          	</nav>
		          	<!--/ Pagination -->
		        </div>
	      	</div>
	    </div>

  	</div>
</div>
<!--/ Bordered Table -->

@endsection
