@extends('auth.master')
@section('content')
<div class="col-12 col-md-6">
    <div class="card p-3">
      <div class="card-header">
        <span class="fs-5">Login here</span>
      </div>
      <div class="card-body">
          @if (session("error"))
              <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-1"></i>{{session("error")}}
              </div>
          @endif
          @if (session("success"))
              <div class="alert alert-success">
                <i class="fas fa-check-square me-1"></i>{{session("success")}}
              </div>
          @endif
        <form action="" method="POST">
            @csrf
          <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" class="form-control p-md-3" />
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" class="form-control p-md-3" />
          </div>
          <div
            class="d-flex justify-content-between align-items-center"
          >
            <button class="btn btn-info" type="submit">Signin</button>
            <a href="{{url("/register")}}" class="btn btn-link ms-auto">register</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('auth-links')
<li class="nav-item">
    <a href="{{url("/signin")}}" class="nav-link nav-link-me active-link">Signin<span></span></a>
</li>
<li class="nav-item">
   <a href="{{url("/register")}}" class="nav-link nav-link-me">Register<span></span></a>
</li>
@endsection
