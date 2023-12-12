@extends('navMainLayout')

@section('title', 'Category List')

@section('content')
<div class="layout-demo-wrapper" style="align-items:flex-start;">
	<h4 class="fw-bold">
		Category 
	</h4>
</div> 
<div class="layout-demo-wrapper create_btn_fix">
	<a href="{{ route('category.create') }}" class="btn btn-primary a_btn_fix" role="button">
		<span class="tf-icons bx bxs-discount me-1"></span>&nbsp; Create
	</a>
</div>

<div class="card">
  	<h5 class="card-header">Category List </h5>
  	
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
			            <th>Slug</th>
			            <th>Actions</th>
		          	</tr>
		        </thead>
		        <tbody>
		        	@forelse($categories as $cate)
		        		<tr>
				            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $cate->name }}</strong></td>
				            <td>{{ $cate->slug }}</td>
				            <td>
				            	<div class="d-inline-block text-nowrap">
				            		<a href="{{ route('category.edit',$cate->id) }}" class="btn btn-sm btn-icon edit-record" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="View" data-bs-original-title="Edit"><i class="bx bx-edit"></i></a>
				            	</div>
				            </td>
			          	</tr>
		        	@empty
		                <tr>
		                    <td colspan="3">There are no categories.</td>
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
		            {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}
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

@endsection