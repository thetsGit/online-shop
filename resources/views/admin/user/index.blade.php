@extends('admin.user.master')

@section('content')
<div class="card px-3 py-4" id="main-content">
    <div class="table-responsive py-3" style="overflow-y: hidden">
      <table class="table table-striped" >
        <thead>
          <tr class="sticky-top bg-white">
            <th class="align-middle">User</th>
            <th class="align-middle">Email</th>
            <th class="align-middle">Total Orders</th>
            <th class="align-middle">Last Modified</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="table-row">
            <td class="align-middle">
                <img
                src="{{asset("image/$user->image")}}"
                class="user-profile"
                alt=""
              />
              <span class="text-info mx-1">
                &bull;
              </span>
              <span class="fw-bold">{{$user->name}}</span></td>
            <td class="align-middle">{{$user->email}}</td>
            <td class="align-middle">
             <span class="fs-6 fw-bold">{{count($user->order)}}</span>
            </td>
            <td class="align-middle">{{$user->updated_at->diffForHumans()}}</td>
          </tr>
            @endforeach
        </tbody>
      </table>
      <div class="mt-3" style="overflow: hidden">
        <span class="d-inline-block float-end">
            {{$users->links()}}
        </span>
    </div>
    </div>
  </div>
@endsection
