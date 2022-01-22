@extends('auth.master')
@section('content')
<div class="col-12 col-md-6">
    <div class="card p-3">
      <div class="card-header">
        <span class="fs-5">Register here</span>
      </div>
      <div class="card-body">
          @if ($errors->any())
              <ul class="alert alert-danger" style="list-style: none">
                  @foreach ($errors->all() as $e)
                      <li><i class="fas fa-exclamation-triangle me-1"></i>{{$e}}</li>
                  @endforeach
              </ul>
          @endif
        <form action="{{url("/register")}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" name="name" class="form-control p-md-3" required />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" class="form-control p-md-3" required />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control p-md-3" required />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Profile Image</label>
                <input type="file" name="image" class="form-control p-md-3"  />
                {{-- required accept="image/jpg,image/jpeg,image/png" --}}
            </div>
            <div
                class="d-flex justify-content-between align-items-center"
            >
            <button class="btn btn-info" type="submit">Register</button>
            <a href="{{url("/signin")}}" class="btn btn-link ms-auto">signin</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('auth-links')
<li class="nav-item">
    <a href="{{url("/signin")}}" class="nav-link nav-link-me">Signin<span></span></a>
</li>
<li class="nav-item">
   <a href="{{url("/register")}}" class="nav-link nav-link-me active-link">Register<span></span></a>
</li>
@endsection
