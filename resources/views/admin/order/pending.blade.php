@extends('admin.order.pendingMaster')

@section('content')
<div class="card px-3 py-4" id="main-content">
    @if (session('success'))
    <div class="alert alert-info">
        {{session('success')}}
    </div>
@endif
@if (count($pendingOrders) === 0)
    <div class="text-center">
        <span class="badge bg-warning">
            No order yet
        </span>
    </div>

@else
    <div class="table-responsive py-3" style="overflow-y: hidden">
      <table class="table table-striped">
        <thead>
          <tr class="sticky-top bg-white">
            <th class="align-middle">User</th>
            <th class="align-middle">Product</th>
            <th class="align-middle">Qty</th>
            <th class="align-middle">Total Price</th>
            <th class="align-middle">Option</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($pendingOrders as $pendingOrder)
          <tr class="table-row">
            <td class="align-middle">{{$pendingOrder->user->name}}</td>
            <td class="align-middle">{{$pendingOrder->product->name}}</td>
            <td class="align-middle">{{$pendingOrder->quantity}}</td>
            <td class="align-middle">{{$pendingOrder->quantity*$pendingOrder->product->price}}</td>
            <td class="align-middle">
                    <form action="{{url("/admin/orders/makeComplete/$pendingOrder->id")}}" method="POST" class="m-0 p-0 d-inline" onsubmit="return confirm('{{"Are you sure to confirm order ID "."\"".$pendingOrder->id."\"?"}}')">
                    @csrf
                    @method('PUT')
                    <input type="text" style="display: none" name="action" value="confirm">
                <button type="submit" class="btn btn-sm btn-danger me-1">
                confirm</button
              >
                </form>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
      <div class="mt-3">
        <span class="d-inline-block float-end" style="overflow: hidden">
            {{$pendingOrders->links()}}
        </span>
    </div>
    </div>
@endif

  </div>
@endsection
