@extends('admin.auth.master')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card position-relative my-3" style="z-index: 1000;">
                <div class="card-header">
                    <div class="px-md-3 p-1 text-center mb-3 d-none d-md-block" style="z-index: 1000">
                        <i class="fas fa-cat text-danger fa-2x"></i>
                        <span class="pop-one text-warning d-lg-inline d-none" id="logo-text">Savannah</span>
                      </div>
                </div>
                <div class="card-body">
                    @if (session("error"))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{session("error")}}
                        </div>
                    @endif
                    <form action="{{url("admin/login")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-danger" type="submit">login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
