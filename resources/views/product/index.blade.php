@extends("layout.master")
@section('nav-items')
<nav
class="navbar navbar-light text-black navbar-expand-lg bg-transparent w-100 shadow-0"
style="position: fixed; display: block; top: 0; z-index: 10000"
id="navbar"
>
<div class="container-fluid">
  <a class="navbar-brand text-info" id="navbar-brand" href="#"
    ><span class="ms-1 fw-bold fs-5"
      ><i class="fas fa-cat fs-3"></i><span id="logo-text">Savannah</span></span
    ></a
  >
  <button
    class="navbar-toggler border-0 text-white d-lg-none d-flex justify-content-center align-items-center"
    id="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent"
    data-status="close"
  >
    <i class="fas fa-bars text-black" style="pointer-events: none"></i>
  </button>
  <div
    class="collapse navbar-collapse"
    id="navbarSupportedContent"
    style="z-index: 10000"
  >
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link nav-link-me active-link" aria-current="page" href="{{url("/")}}"
          >Home<span></span
        ></a>
      </li>
      @auth
      @if (auth()->check() && auth()->user()->role === "user")
          <li class="nav-item">
              <a class="nav-link nav-link-me" href="{{url("/favourites#product-section")}}"
              >Favourites<span></span
              ></a>
          </li>
          <li class="nav-item">
              <a class="nav-link nav-link-me position-relative" href="{{url("/cart")}}"
              >Cart<span></span
              ><span class="badge rounded-pill bg-primary" id="cart-count">{{$cart_count}}</span></a
              >
          </li>
          <li class="nav-item">
              <a href="{{url("/profile")}}" class="nav-link nav-link-me">Profile<span></span></a>
          </li>
          <li class="nav-item">
              <a href="{{url("/signout")}}" class="nav-link nav-link-me">Signout<span></span></a>
          </li>
      @endif
      @endauth
      @guest
      <li class="nav-item">
           <a href="{{url("/signin")}}" class="nav-link nav-link-me">Signin<span></span></a>
      </li>
      <li class="nav-item">
          <a href="{{url("/register")}}" class="nav-link nav-link-me">Register<span></span></a>
      </li>
      @endguest

    </ul>
  </div>
</div>
</nav>
@endsection
@section("content")
<div class="container-fluid pt-0 pb-5 position-relative">
    <div class="container">
      <div class="row">

        <!-- products -->
        <div class="py-5">
         <div class="row" id="product-section">
             {{-- filter section --}}
             <div class="col-12 d-flex align-items-center justify-content-center mt-0 mb-5">
                <form class="d-flex justify-content-center align-items-center" action="{{url("/products#product-section")}}" method="GET">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="" class="form-label me-1 my-0">Category:</label>
                        <select class="form-control" name="category" id="">
                            @foreach ($categories as $c)
                                <option value={{$c->slug}}
                                    @if ($requestedCategory && $requestedCategory->slug === $c->slug)
                                        selected
                                    @endif
                                    >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ms-3 d-flex justify-content-center align-items-center">
                         <label for="" class="form-label me-1 my-0">AgeGroup:</label>
                         <select class="form-control" name="ageGroup" id="">
                            @foreach ($ageGroups as $a)
                                <option value={{$a->slug}}
                                    @if ($requestedAgeGroup && $requestedAgeGroup->slug === $a->slug)
                                        selected
                                    @endif
                                    >{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ms-3">
                        <button class="btn btn-outline-danger btn-sm">filter</button>
                    </div>
                </form>
            </div>

             @if ($searchQuery)
              <h3 class="mb-3 fs-4 fw-bold text-left text-capitalize">Searched for "{{$searchQuery}}"</h3>
             @endif
            {{-- <h3 class="mb-3 fs-4 fw-bold text-left text-capitalize">products for {{$category->name}}</h3> --}}
                @if (count($products)>0)
                    @foreach ($products as $product)
                 <div class="col-12 col-lg-3 col-sm-6">
                    <div class="card mt-3">
                      <div class="card-header d-flex justify-content-between">
                        <div>
                          <span class="badge bg-success"> {{$product->ageGroup->name}} </span>
                          <span class="badge bg-info"> {{$product->category->name}} </span>
                        </div>

                        @if (auth()->user())
                        <?php
                        $isFavourite = false;
                        foreach ($product->favourites as $favourite) {
                            if($favourite->user_id === auth()->user()->id){
                                $isFavourite = true;
                            }
                        }
                         ?>
                        <div class="text-warning">
                            {{-- <form class="d-inline" action="{{url("/toggleFavourite")}}" method="POST">
                                @csrf
                                <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                <input type="text" name="product" value="{{$product->id}}" class="d-none">
                                <button type="submit" class="text-warning fs-5 action-btn">
                                    @if ($isFavourite)
                                        <i class="fas fa-star action-icon"></i>
                                    @else
                                        <i class="far fa-star action-icon"></i>
                                    @endif
                                </button>
                            </form> --}}
                            <span class="favouriteBtn fs-5 active-icon" data-product-id={{$product->id}} style="cursor: pointer">
                                <span class="spinner-border text-warning fs-6 d-none spinner-border-sm"></span>
                                @if ($isFavourite)
                                <i class="fas fa-star"></i></span>
                                @else
                                <i class="far fa-star"></i></span>
                                @endif
                            </span>
                        </div>
                        @endif


                      </div>
                      <div class="card-body d-flex justify-content-center">
                        <a href="{{url("/products/".$product->slug)}}">
                            <img src="{{asset("/image/".$product->image)}}" class="img-fluid product-image" alt="" />
                        </a>
                      </div>
                      <div class="card-footer">
                        <p>{{$product->name}}</p>
                        <div
                          class="d-flex justify-content-between mb-2 align-items-center"
                        >
                            @if (auth()->user())
                              <?php
                            $isLiked = false;
                            foreach ($product->likes as $like) {
                                if($like->user_id === auth()->user()->id){
                                    $isLiked = true;
                                }
                            }
                            ?>
                            <div class="fs-5 text-danger">
                                {{-- <form class="d-inline" action="{{url("/toggleLike")}}" method="POST">
                                    @csrf
                                    <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                    <input type="text" name="product" value="{{$product->id}}" class="d-none">
                                    <button type="submit" class="text-danger fs-5 action-btn">
                                        @if ($isLiked)
                                            <i class="fas fa-heart action-icon"></i>
                                        @else
                                            <i class="far fa-heart action-icon"></i>
                                        @endif
                                    </button>
                                </form> --}}
                                <span class="likeBtn fs-5 active-icon" data-product-id={{$product->id}} style="cursor: pointer">
                                    <span class="spinner-border text-danger fs-6 d-none spinner-border-sm"></span>
                                    @if ($isLiked)
                                    <i class="fas fa-heart"></i></span>
                                    @else
                                    <i class="far fa-heart"></i></span>
                                    @endif
                                </span>
                                <small class="ms-1 text-black-50">{{$product->likes_count?$product->likes_count:0}}</small>
                            </div>
                            @endif


                          <span
                            ><sup>mmk</sup><strong class="fs-5">{{$product->price}}</strong></span
                          >
                        </div>
                        @auth
                        {{-- <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                            @csrf
                            <input type="text" name="productId" value="{{$product->id}}" class="d-none" />
                            <button type="submit" class="btn btn-info btn-block m-0">
                                Add to cart
                            </button>
                        </form> --}}
                        <span class="btn btn-info btn-block m-0 cartAddBtn" data-product-id="{{$product->id}}">
                            <span class="spinner-border spinner-border-sm text-white d-none"></span>
                            <span>Add to cart</span>
                        </span>
                        @endauth
                        @guest
                        <button class="btn btn-info btn-block m-0" disabled>
                            <i class="fas fa-lock me-1"></i>Sign In First
                         </button>
                        @endguest

                      </div>
                    </div>
                  </div>
                 @endforeach
                @else
                    <div class="col-12 text-center">
                      <span class="badge bg-danger fs-4">Not found</span>
                    </div>
                @endif

         </div>
         <div class="mt-3 clearfix" style="overflow: hidden">
            <span class="d-inline-block float-end">
                @if (count($products)>0)
                    {{$products->links()}}
                @endif
            </span>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-script')
@include('layout.cartAddScript')
@include('layout.heroAni')
@endsection
