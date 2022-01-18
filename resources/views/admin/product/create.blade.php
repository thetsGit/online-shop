@extends('admin.product.master')
@section('content')
<div class="card px-3 py-4" id='main-content'>

      <div class="clearfix mb-2">
       <a href="{{route('admin.products.index')}}" class="btn btn-warning btn-sm float-end">All</a>
     </div>

  @if ($errors->any())
  <div class="alert alert-danger">
      <ul class="mb-0">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
      <div class="col-lg-4 col-md-6 col-12">
        <div>
          <label for="name" class="form-label">Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            placeholder="eg.Addidas ClassicX"
            required
          />
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div>
          <label for="price" class="form-label">Price</label>
          <input
            type="text"
            class="form-control"
            id="price"
            name="price"
            placeholder="eg.15000"
            required
          />
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div>
          <label for="image" class="form-label">Image</label>
          <input type="file" name="image" class="form-control" id="image" required/>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea
        class="form-control summernote"
        name="description"
        id="description"
        rows="3"
        required
      ></textarea>
    </div>
    <label for="" class="mb-2">Select</label>
    <div class="row">
      <div class="col-md-6 col-12">
        <select class="form-select mb-3" name="category" required>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
      </div>
      <div class="col-md-6 col-12">
        <select class="form-select mb-3" name="ageGroup" required>
            @foreach ($ageGroups as $ageGroup)
                <option value="{{$ageGroup->id}}">{{$ageGroup->name}}</option>
            @endforeach
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-danger">Add</button>
  </form>
</div>
@endsection
