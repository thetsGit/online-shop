@extends("layout.master")
@section("content")
<div class="container-fluid pt-0 pb-5 position-relative">
    <div class="container">
        <div class="row">
            <!-- categories -->
            <div class="col-12 col-md-3 py-5 col-lg-2 px-3">
                <div class="position-sticky" style="top: 5rem">
                    <div class="mb-3 fw-bold fs-5">Categories</div>
                    <ul class="list-group-flush m-0 p-0">
                    @foreach ($categories as $c)
                        <a href="{{url("/products/category/$c->slug"."#product-section")}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        ><span>{{$c->name}}</span>
                        <span class="badge bg-danger">{{$c->product_count}}</span></a
                        >
                    @endforeach
                    </ul>
                </div>
            </div>

            <!-- products -->
            <div class="col-12 col-md-9 col-lg-10" id="product-section">

                {{-- filter section --}}
                <div class="col-12 d-flex align-items-center justify-content-center mt-5">
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
                @foreach ($ageGroups as $ageGroup)
                    @php
                        $filteredProducts = [];
                        foreach ($products as $p) {
                            if($p->ageGroup->name === $ageGroup->name){
                                $filteredProducts[] = $p;
                            }
                    }
                    @endphp
                    @if (count($filteredProducts) > 0)
                        <div class="row pb-5 m-0" id="{{$ageGroup->name}}">
                                <div
                                class="col-12 d-flex justify-content-between align-items-center mb-3"
                                >
                                    <span class="fs-3 fw-bold">For {{ ucwords($ageGroup->name)}} </span>
                                    @if (count($filteredProducts) > 4)
                                        <a href="{{url("/products/ageGroup/".$ageGroup->slug."#product-section")}}" class="btn-link btn"> See all </a>
                                    @endif

                                </div>
                            @if (count($filteredProducts) <= 4)
                                @foreach ($filteredProducts as $filteredProduct)
                                    <div class="col-12 col-lg-3 col-sm-6">
                                        <div class="card m-0">
                                        <div class="card-header d-flex justify-content-between">
                                            <div>
                                            <span class="badge bg-success"> {{$filteredProduct->category->name}} </span>
                                            <span class="badge bg-warning"> {{$filteredProduct->ageGroup->name}}  </span>
                                            </div>
                                            @auth
                                                <?php
                                                $isFavourite = false;
                                                foreach ($filteredProduct->favourites as $favourite) {
                                                    if($favourite->user_id === auth()->user()->id){
                                                        $isFavourite = true;
                                                    }
                                                }
                                            ?>
                                            <div class="text-warning">
                                                <form class="d-inline" action="{{url("/toggleFavourite")}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                                    <input type="text" name="product" value="{{$filteredProduct->id}}" class="d-none">
                                                    <button type="submit" class="text-warning fs-5 action-btn">
                                                        @if ($isFavourite)
                                                            <i class="fas fa-star action-icon"></i>
                                                        @else
                                                            <i class="far fa-star action-icon"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
                                            @endauth


                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <a href="{{url("/products/".$filteredProduct->slug)}}">
                                              <img src="{{asset("/image/".$filteredProduct->image)}}" class="img-fluid product-image" alt="" />
                                            </a>

                                        </div>
                                        <div class="card-footer">
                                            <p>{{$filteredProduct->name}}</p>
                                            <div
                                            class="d-flex justify-content-between mb-2 align-items-center"
                                            >


                                            @if (auth()->user())
                                                <?php
                                                $isLiked = false;
                                                foreach ($filteredProduct->likes as $like) {
                                                    if($like->user_id === auth()->user()->id){
                                                        $isLiked = true;
                                                    }
                                                }
                                            ?>
                                            <div class="fs-5 text-danger">
                                                <form class="d-inline" action="{{url("/toggleLike")}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                                    <input type="text" name="product" value="{{$filteredProduct->id}}" class="d-none">
                                                    <button type="submit" class="text-danger fs-5 action-btn">
                                                        @if ($isLiked)
                                                            <i class="fas fa-heart action-icon"></i>
                                                        @else
                                                            <i class="far fa-heart action-icon"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                                <small class="ms-1 text-black-50">{{$filteredProduct->likes_count?$filteredProduct->likes_count:0}}</small>
                                            </div>
                                            @endif

                                            <span
                                                ><sup>mmk</sup><strong class="fs-5">{{$filteredProduct->price}}</strong></span
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
                            @else
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="col-12 col-lg-3 col-sm-6">
                                        <div class="card m-0">
                                        <div class="card-header d-flex justify-content-between">
                                            <div>
                                            <span class="badge bg-success"> {{$filteredProducts[$i]->category->name}} </span>
                                            <span class="badge bg-info"> {{$filteredProducts[$i]->ageGroup->name}}  </span>
                                            </div>

                                            @if (auth()->user())
                                                <?php
                                                $isFavourite = false;
                                                foreach ($filteredProducts[$i]->favourites as $favourite) {
                                                    if($favourite->user_id === auth()->user()->id){
                                                        $isFavourite = true;
                                                    }
                                                }
                                            ?>
                                            <div class="text-warning">
                                                <form class="d-inline" action="{{url("/toggleFavourite")}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                                    <input type="text" name="product" value="{{$filteredProducts[$i]->id}}" class="d-none">
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
                                            <a href="{{url("/products/".$filteredProducts[$i]->slug)}}">
                                            <img src="{{asset("/image/".$filteredProducts[$i]->image)}}" class="img-fluid product-image" alt="" />
                                            </a>
                                        </div>
                                        <div class="card-footer">
                                            <p>{{$filteredProducts[$i]->name}}</p>
                                            <div
                                            class="d-flex justify-content-between mb-2 align-items-center"
                                            >

                                            @if (auth()->user())
                                                <?php
                                                $isLiked = false;
                                                foreach ($filteredProducts[$i]->likes as $like) {
                                                    if($like->user_id === auth()->user()->id){
                                                        $isLiked = true;
                                                    }
                                                }
                                            ?>
                                            <div class="fs-5 text-danger">
                                                <form class="d-inline" action="{{url("/toggleLike")}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                                    <input type="text" name="product" value="{{$filteredProducts[$i]->id}}" class="d-none">
                                                    <button type="submit" class="text-danger fs-5 action-btn">
                                                        @if ($isLiked)
                                                            <i class="fas fa-heart action-icon"></i>
                                                        @else
                                                            <i class="far fa-heart action-icon"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                                <small class="ms-1 text-black-50">{{$filteredProducts[$i]->likes_count?$filteredProducts[$i]->likes_count:0}}</small>
                                            </div>
                                            @endif


                                            <span>
                                            <sup>mmk</sup><strong class="fs-5">{{$filteredProducts[$i]->price}}</strong></span
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
                                @endfor
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
