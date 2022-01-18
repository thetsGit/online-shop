@extends('admin.layout.master')

@section('aside')
<ul class="list-group flex-row flex-md-column">
    <a
    href="{{url('/admin')}}"
    class="list-group-item list-group-item-action text-center text-lg-start d-inline-block d-md-block flex-grow-1"
    >
        <i class="fas fa-home"></i>
        <span class="d-none d-lg-inline ms-1">Home</span>
    </a>
    <a
      href="{{url('/admin/categories')}}"
      class="list-group-item text-center text-lg-start list-group-item-action d-inline-block d-md-block flex-grow-1"
    >
      <i class="fas fa-tags"></i>
      <span class="d-none d-lg-inline ms-1">Categories</span>
    </a>
    <a
      href="{{url('/admin/ageGroups')}}"
      class="list-group-item list-group-item-action text-center text-lg-start d-inline-block d-md-block flex-grow-1"
    >
      <i class="fas fa-users"></i>
      <span class="d-none d-lg-inline ms-1">Age-groups</span>
    </a>
    <a
      href="{{url('/admin/users')}}"
      class="list-group-item list-group-item-action text-center text-lg-start d-inline-block d-md-block flex-grow-1"
    >
      <i class="fas fa-user-friends"></i>
      <span class="d-none d-lg-inline ms-1">Users</span
      ></a
    >
    <a
    href="{{url('/admin/orders/pending')}}"
    class="list-group-item active bg-danger border-danger text-center text-lg-start d-inline-block d-md-block flex-grow-1"
  >
    <i class="fas fa-clipboard-list"></i>
    <span class="d-none d-lg-inline ms-1">Pending Orders</span
    ></a
  >
  <a
    href="{{url('/admin/orders/complete')}}"
    class="list-group-item list-group-item-action text-center text-lg-start d-inline-block d-md-block flex-grow-1"
  >
    <i class="fas fa-clipboard-list"></i>
    <span class="d-none d-lg-inline ms-1">Complete Orders</span
    ></a
  >
    <a
      href="{{url('/admin/products')}}"
      class="list-group-item list-group-item-action text-center text-lg-start d-inline-block d-md-block flex-grow-1"
    >
      <i class="fas fa-tshirt"></i
      ><span class="d-none d-lg-inline ms-1">Products</span
      ></a
    >
  </ul>

@endsection
