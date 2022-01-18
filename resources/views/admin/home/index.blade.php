@extends('admin.home.master')
@section('content')
<div class="card px-3 bg-gradient-white">
    <div class="card-header mb-0">
        <h3 class='text-black-50 mb-0'>Dashboard</h3>
    </div>
    <div class="card-body">
        @if (session("success"))
            <div class="alert alert-success">
                <i class="fas fa-check-square me-2"></i>{{session("success")}}
            </div>
        @endif
        <h3 class="mb-3">Statistics</h3>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
            <div class="card bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                        <div class="fs-6 text-black-50">
                                Total Users
                        </div>
                        <div class="fs-4 fw-bold" id="user-count">
                            {{$totalUsers}}
                        </div>
                    </div>
                    <a href="{{url('/admin/users')}}">
                        <div class="rounded-circle d-flex justify-content-center align-items-center text-white bg-gradient-red" style="width: 3rem;height: 3rem">
                            <i class="fas fa-users"></i>
                        </div>
                    </a>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                        <div class="fs-6 text-black-50">
                                Pending Orders
                        </div>
                        <div class="fs-4 fw-bold" id="order-count">
                            {{$orderCount}}
                        </div>
                    </div>
                    <a href="{{url('/admin/orders/pending')}}">
                        <div class="rounded-circle d-flex justify-content-center align-items-center text-white bg-gradient-info" style="width: 3rem;height: 3rem">
                            <i class="fas fa-gifts"></i>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                        <div class="fs-6 text-black-50">
                                Total Views
                        </div>
                        <div class="fs-4 fw-bold" id="total-view-count">
                            {{$totalViewCount}}
                        </div>
                    </div>
                    <a href="{{url("/admin/products")}}">
                        <div class="rounded-circle d-flex justify-content-center align-items-center text-white bg-gradient-success" style="width: 3rem;height: 3rem">
                            <i class="fas fa-eye"></i>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h3 class="mb-3">Latest Orders</h3>
                    <div class="card p-3">
                        <div class="table-responsive" style="overflow-y: hidden">
                            <table class="table table-striped">
                                <thead class="table-header">
                                    <tr>
                                        <th class="align-middle">User</th>
                                        <th class="align-middle">Product</th>
                                        <th class="align-middle">Status</th>
                                    </tr>

                                </thead>
                                <tbody class="table-body">
                                    @foreach ($latestOrders as $order)
                                    <tr class="table-row">
                                        <td class="align-middle">{{$order->user->name}}</td>
                                        <td class="align-middle">{{$order->product->name}}</td>
                                        <td class="align-middle d-flex align-items-center my-0"><span class="{{$order->status==="pending"? "text-danger":"text-success"}} mx-1" >&bull; {{$order->status}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <h3 class="mb-3">Highest Demand Products</h3>
                    <div class="card p-3">
                        <div class="table-responsive" style="overflow-y: hidden">
                            <table class="table table-striped">
                                <thead class="table-header">
                                    <tr>
                                        <th class="align-middle">Product</th>
                                        <th class="align-middle">Revenue</th>
                                    </tr>

                                </thead>
                                <tbody class="table-body">
                                    @foreach ($highDemandProducts as $product=>$revenue)
                                    <tr class="table-row">
                                        <td class="align-middle">{{$product}}</td>
                                        <td class="align-middle"><strong class="fw-bold">{{$revenue}}</strong> Ks</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
@section('text-count')
<script>

 const datas = {
     viewCount: 0,
     orderCount: 0,
     userCount: 0
 }
  anime({
  targets: datas,
  orderCount: {{$orderCount}},
  userCount: {{$totalUsers}},
  viewCount: {{$totalViewCount}},
  easing: 'linear',
  round: 1,
  update: function() {
    document.querySelector('#order-count').innerHTML = datas.orderCount;
    document.querySelector('#user-count').innerHTML = datas.userCount;
    document.querySelector('#total-view-count').innerHTML = datas.viewCount;
  }
});
    </script>
@endsection
