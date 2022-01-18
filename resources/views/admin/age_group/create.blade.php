@extends('admin.age_group.master')
@section('content')
<div
class="card px-3 py-4 mt-0"
id="main-content"
style="max-height: 80vh; overflow: auto"
>
    <div class="clearfix mb-2">
  <a href="{{route('admin.ageGroups.index')}}" class="btn btn-warning btn-sm float-end">All</a>

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
<form method="POST" action="{{route('admin.ageGroups.store')}}">
  @csrf
  <div class=" mb-4">
    <div class="form-label mb-2" for='age-group-name'><strong>Enter age-group</strong></div>
    <input name='name' type="text" class="form-control p-2" id='age-group-name' placeholder="eg.men" />
  </div>

  <button type="submit" class="btn btn-danger">add</button>
</form>
</div>
@endsection
