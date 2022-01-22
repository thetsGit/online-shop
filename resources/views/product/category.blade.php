@extends("layout.master")
@section("content")
<div class="container-fluid pt-0 pb-5 position-relative">
    <div class="container">
      <div class="row">
        <!-- ageGroups -->
        <div class="col-12 col-md-3 py-5 col-lg-2 px-3">
          <div class="position-sticky" style="top: 5rem">
            <div class="mb-3 fw-bold fs-5">Age Groups</div>
            <ul class="list-group-flush m-0 p-0">
              @foreach ($ageGroups as $a)
              @if ($a->product_count>0)
                @if ($requestedAgeGroup && $requestedAgeGroup->name === $a->name)
                <a href="{{url("/product/category/$category->slug"."?"."ageGroup=".$a->slug."#product-section")}}" class="list-group-item active bg-primary d-flex justify-content-between align-items-center" style="border-color: #2ba9cd;!important">
                    <span>{{$a->name}}</span>
                </a>
               @else
                <a href="{{url("/products/category/$category->slug"."?"."ageGroup=".$a->slug."#product-section")}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{$a->name}}</span>
                    <span class="badge bg-danger">{{$a->product_count}}</span>
                </a>
               @endif
              @endif
              @endforeach
            </ul>
          </div>
        </div>

        <!-- products -->
        <div class="col-12 col-md-9 col-lg-10 py-5">
         <div class="row" id="product-section">
             {{-- filter section --}}
             <div class="col-12 d-flex align-items-center justify-content-center mt-0 mb-5">
                <form class="d-flex justify-content-center align-items-center" action="{{url("/products#product-section")}}" method="GET">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="" class="form-label me-1 my-0">Category:</label>
                        <select class="form-control" name="category" id="">
                            @foreach ($categories as $c)
                                <option value={{$c->slug}}>{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ms-3 d-flex justify-content-center align-items-center">
                         <label for="" class="form-label me-1 my-0">AgeGroup:</label>
                         <select class="form-control" name="ageGroup" id="">
                            @foreach ($ageGroups as $a)
                                <option value={{$a->slug}}>{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ms-3">
                        <button class="btn btn-outline-danger btn-sm">filter</button>
                    </div>
                </form>
        </div>
            <h3 class="mb-3 fs-4 fw-bold text-left text-capitalize">products for {{$category->name}}</h3>
                 @foreach ($products as $product)
                 <div class="col-12 col-lg-3 col-sm-6">
                    <div class="card mt-3">
                      <div class="card-header d-flex justify-content-between">
                        <div>
                          <span class="badge bg-success"> {{$product->ageGroup->name}} </span>
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
                            <form class="d-inline" action="{{url("/toggleFavourite")}}" method="POST">
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
                            </form>
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
                            <form class="d-inline" action="{{url("/toggleLike")}}" method="POST">
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
                            </form>
                            <small class="ms-1 text-black-50">{{$product->likes_count?$product->likes_count:0}}</small>
                        </div>
                        @endif


                          <span
                            ><sup>mmk</sup><strong class="fs-5">{{$product->price}}</strong></span
                          >
                        </div>
                        @auth
                        <button class="btn btn-info btn-block m-0">
                          Add to cart
                        </button>
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
         </div>
         <div class="mt-3 clearfix" style="overflow: hidden">
            <span class="d-inline-block float-end">
                {{$products->links()}}
            </span>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
