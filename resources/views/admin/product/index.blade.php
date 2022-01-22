@extends('admin.product.master')
@section('content')
<div class="card px-3 py-4" id="main-content">

      <div class="clearfix mb-2">
       <a href="{{route('admin.products.create')}}" class="btn btn-warning float-end btn-sm">create product</a>
      </div>



  @if (session('success'))
      <div class="alert alert-info">
        <i class="fas fa-check-square me-1"></i>{{session("success")}}
      </div>
  @endif

            <div class="table-responsive" style="overflow-y: hidden">
                <table class="table table-striped">
                    <thead class="sticky-top">
                     <tr>
                         <th class="align-middle">Product</th>
                         <th class="align-middle">Tags</th>
                         <th class="align-middle">Price</th>
                         <th class="align-middle">Views</th>
                         <th class="align-middle">Options</th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="table-row">
                        <td class="align-middle"><img src="{{asset("image/$product->image")}}" class="card-img-top product-img" alt="{{$product->name}}" /><span class="text-info mx-1">&bull;</span><strong>{{$product->name}}</strong></td>
                        <td class="align-middle">
                            <span class="badge bg-success">
                                <a href="{{url('/admin/categories')}}">{{$product->category->name}}</a>
                            </span>
                            <span class="badge bg-info">
                                <a href="{{url('/admin/ageGroups')}}">{{$product->ageGroup->name}}</a>
                            </span>
                        </td>
                        <td class="align-middle"><bold class="fw-bold fs-5">{{$product->price}} </bold>Ks</td>
                        <td class="align-middle"><bold class="fw-bold fs-5">{{$product->view_count}} </bold></td>
                        <td class="align-middle">
                            <a href="{{route('admin.products.edit',['product'=>$product->id])}}" class="btn btn-danger btn-sm">Edit</a>
                            <form action="{{route('admin.products.destroy',['product'=>$product->id])}}" method="POST" style="display:inline;" onsubmit="return confirm('{{"Are you sure to delete "."\"".$product->name."\"?"}}')">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3" style="overflow: hidden">
                    <span class="d-inline-block float-end">
                        {{$products->links()}}
                    </span>
                </div>
            </div>

</div>
@endsection
