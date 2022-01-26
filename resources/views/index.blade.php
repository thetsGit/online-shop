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
  >
    <i class="fas fa-bars"></i>
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
              ><span class="badge rounded-pill bg-primary">{{$cart_count}}</span></a
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
            <!-- categories -->
            <div class="col-12 col-md-3 py-5 col-lg-2 px-3">
                <div class="position-sticky" style="top: 5rem">
                    <div class="mb-3 fw-bold fs-5">Categories</div>
                    <ul class="list-group-flush m-0 p-0">
                    @foreach ($categories as $c)
                        <a href="{{url("/products/category/$c->slug"."#product-section")}}" class="d-inline-block category-text list-group-item list-group-item-action d-flex justify-content-between align-items-center"
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
                                        <div class="card m-0 product-card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div>
                                            <span class="badge bg-success"> {{$filteredProduct->category->name}} </span>
                                            <span class="badge bg-warning"> {{$filteredProduct->ageGroup->name}}  </span>
                                            </div>
                                            @auth
                                            @if (auth()->user()->role === "user")
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
                                            @endif
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


                                            @if (auth()->user() && auth()->user()->role === "user")
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
                                            @if (auth()->user()->role === "user")
                                            <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                                                @csrf
                                                <input type="text" name="productId" value="{{$filteredProduct->id}}" class="d-none" />
                                                <button type="submit" class="btn btn-info btn-block m-0">
                                                    Add to cart
                                                </button>
                                            </form>
                                            @endif
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
                                        <div class="card m-0 product-card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div>
                                            <span class="badge bg-success"> {{$filteredProducts[$i]->category->name}} </span>
                                            <span class="badge bg-info"> {{$filteredProducts[$i]->ageGroup->name}}  </span>
                                            </div>

                                            @if (auth()->user() && auth()->user()->role === "user")
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

                                            @if (auth()->user() && auth()->user()->role === "user")
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
                                            @if (auth()->user()->role === "user")
                                            <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                                                @csrf
                                                <input type="text" name="productId" value="{{$filteredProducts[$i]->id}}" class="d-none" />
                                                <button type="submit" class="btn btn-info btn-block m-0">
                                                    Add to cart
                                                </button>
                                            </form>
                                            @endif
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
@section('extra-script')
    <script>
         window.addEventListener("load",()=>{
            $("#loading-show").addClass("d-none");
            $("#loaded-content").removeClass("d-none");
    });
      $(()=>{
        const browse = document.getElementById("browse");
        const get = document.getElementById("get");
        const everything = document.getElementById("everything");
        const online = document.getElementById("online");
        const categoryTexts = document.querySelectorAll(".category-text");
        const productCards = document.querySelectorAll(".product-card");

        const options = {
        // root: document.querySelector('#body'),
        rootMargin: '0px',
        threshold: 1.0
        }

        const callback1 = (entries,observer)=>{
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    anime({
                    targets: entry.target,
                    translateY: 0,
                    scale: 1,
                    opacity: 1,
                    duration: 300,
                    });
                    observer.unobserve(entry.target);
                }
                console.log(entry.target);
            });

        };

        const observer1 = new IntersectionObserver(callback1, options);
        categoryTexts.forEach( (cateText,index,list) => {
            observer1.observe(cateText);
        });

        const callback2 = (entries,observer)=>{
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    anime({
                    targets: entry.target,
                    translateY: 0,
                    scale: 1,
                    opacity: 1,
                    duration: 300,
                    });
                    observer.unobserve(entry.target);
                }
                console.log(entry.target);
            });

        };

        const observer2 = new IntersectionObserver(callback2, options);
        productCards.forEach( (productCard,index,list) => {
            observer2.observe(productCard);
        })


        browse.innerHTML = browse.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
        get.innerHTML = get.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
        everything.innerHTML = everything.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
        online.innerHTML = online.innerHTML.split("").map(char => `<span class="jumping-char d-inline-block">${char}</span>`).join("");
        anime.timeline({
          easing: "linear",
          delay: 1500
        }).add({
            targets: ".jumping-char",
            translateY: [0,-20,0],
            translateX: [0,20,0],
            scale:[1,2,1],
            delay: anime.stagger(30)
        }).add({
            targets: "#search-box",
            translateY: [30,0],
            opacity: [0,1],
            duration: 500
        },800).add({
            targets: "#supporting-text",
            translateY: [30,0],
            opacity: [0,1],
            duration: 500
        },1000).add({
            targets: ".rotating-agegroup-text",
            rotate: "3turn",
            translateX: [1000,0]
        },1000);
      });
    </script>
@endsection
