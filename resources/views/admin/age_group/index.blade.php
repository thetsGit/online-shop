@extends('admin.age_group.master')

@section('content')
<div class="card px-3 py-4"
id="main-content">

    <div class="clearfix mb-2">
        <a href="{{route('admin.ageGroups.create')}}" class="btn btn-warning btn-sm float-end">create age-group</a>
    </div>

     @if (session('success'))
         <div class="alert alert-info">
            <i class="fas fa-check-square me-1"></i>{{session('success')}}
         </div>
     @endif
    <div class="table-responsive" style="overflow-y: hidden">
      <table class="table table-striped">
        <thead>
          <tr class="sticky-top bg-white">
            <th>Name</th>
            <th>Slug</th>
            <th>Last Modified</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody style="overflow:hidden">
          @foreach ($ageGroups as $ageGroup)
          <tr class="table-row">
            <td class="align-middle"><span class="fw-bold">{{$ageGroup->name}}</span></td>
            <td class="align-middle">{{$ageGroup->slug}}</td>
            @if ($ageGroup->updated_at)
               <td class="align-middle">{{$ageGroup->updated_at->diffForHumans()}}</td>
            @else
            <td class="align-middle">{{$ageGroup->created_at->diffForHumans()}}</td>
            @endif

            <td class="align-middle">
              <a href="{{route('admin.ageGroups.edit',['ageGroup'=>$ageGroup->id])}}" class="btn btn-danger btn-sm">edit</a>
              <form method="POST" action="{{route('admin.ageGroups.destroy',['ageGroup'=>$ageGroup->id])}}" style="display:inline" onsubmit="return confirm('{{"Are you sure to delete "."\"".$ageGroup->name."\"?"}}')">
                @method('DELETE')
                @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm">delete</a>
            </form>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-3">
        <span class="d-inline-block float-end" style="overflow: hidden">
            {{$ageGroups->links()}}
        </span>
    </div>

</div>
  </div>
@endsection
