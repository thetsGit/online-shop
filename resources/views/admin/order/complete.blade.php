@extends('admin.order.completeMaster')

@section('content')
<div class="card px-3 py-4" id="main-content">
    @if (session('success'))
    <div class="alert alert-info">
        {{session('success')}}
    </div>
@endif
@if (count($completeOrders) === 0)
    <div class="text-center">
        <span class="badge bg-warning">
            No order yet
        </span>
    </div>

@else
<div class="p-3">
    <div class="card w-100 p-3 m-0 bg-danger">
        <form action="" method="GET">
            <div class="row mb-3">
            <div class="col-12 col-md-6">
                <label for="" class="form-label text-white-50">From</label>
                <input type="date" class="form-control" name='start_date'>
        </div>
        <div class="col-12 col-md-6">
                <label for="" class="form-label text-white-50">To</label>
                <input type="date" class="form-control" name='end_date'>
        </div>
    </div>
        <button type='submit' class="btn btn-secondary text-danger btn-sm">filter</button>
        </form>
</div>
</div>

    <div class="table-responsive" style="overflow-y: hidden">
      <table class="table table-striped">
        <thead>
          <tr class="sticky-top bg-white">
            <th class="align-middle">User</th>
            <th class="align-middle">Product</th>
            <th class="align-middle">Qty</th>
            <th class="align-middle">Total Price</th>
            <th class="align-middle">Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($completeOrders as $completeOrder)
          <tr class="table-row">
            <td class="align-middle">{{$completeOrder->user->name}}</td>
            <td class="align-middle">{{$completeOrder->product->name}}</td>
            <td class="align-middle">{{$completeOrder->quantity}}</td>
            <td class="align-middle">{{$completeOrder->quantity*$completeOrder->product->price}}</td>
            <td class="align-middle">
                  {{$completeOrder->updated_at->diffForHumans()}}
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
      <div class="mt-3">
        <span class="d-inline-block float-end" style="overflow: hidden">
            {{$completeOrders->links()}}
        </span>
    </div>
    </div>
@endif

  </div>
@endsection
