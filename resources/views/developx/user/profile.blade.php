@extends('navMainLayout')

@section('title', 'Edit Profile')

@section('page-script')
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profile /</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @elseif (session('error'))
      <div class="alert alert-danger" role="alert">
        {{ session('error') }}
      </div>
    @endif
  </div>
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Name</label>
              <input class="form-control" type="text" id="name" name="name" value="{{ $data['name'] }}" />
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="{{ $data['email'] }}" readonly />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Edit</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>

  </div>

  <!--password block-->
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Change Password</h5>
      <!-- Account -->
      <hr class="my-0">
      
      <div class="card-body">
        
        <form action="{{ route('update-password') }}" method="POST">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="old_password" class="form-label">Old Password</label>
              <input name="old_password" type="password" class="form-control" id="old_password" placeholder="Old Password">
              @error('old_password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
            </div>
            <div class="mb-3 col-md-6">
              <label for="new_password" class="form-label">New Password</label>
              <input name="new_password" type="password" class="form-control" id="new_password" placeholder="New Password">
              @error('new_password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
              <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation" placeholder="Confirm New Password">
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Confirm</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>

  </div>
  <!--end change password block-->
</div>
@endsection
