@extends('admin.category.master')
@section('content')
<div
class="card px-3 py-4 mt-0"
id="main-content"
style="max-height: 80vh; overflow: auto"
>

    <div class="clearfix mb-2">
  {{-- <h3 class="d-inline pop-one">Update</h3> --}}
  <a href="{{route('admin.categories.index')}}" class="btn btn-warning btn-sm float-end">All</a>

</div>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form method="POST" action="{{route('admin.categories.update',['category'=>$category->id])}}">
  @csrf
  @method('PUT')
  <div class=" mb-4">
    <div class="form-label mb-2" for='category-name'><strong>Enter category name</strong></div>
    <input name='name' type="text" class="form-control p-2" id='category-name' value="{{$category->name}}" placeholder="eg.shirt" />
  </div>

  <button type="submit" class="btn btn-danger">update</button>
</form>
</div>
@endsection
