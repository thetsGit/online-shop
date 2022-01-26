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
      ><i class="fas fa-cat fs-3"></i>Savannah</span
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
        <a class="nav-link nav-link-me" aria-current="page" href="{{url("/")}}"
          >Home<span></span
        ></a>
      </li>
      @auth
      @if (auth()->check() && auth()->user()->role === "user")
          <li class="nav-item">
              <a class="nav-link nav-link-me active-link" href="{{url("/favourites#product-section")}}"
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
<div class="container-fluid p-5 position-relative">
    <div class="container">
        <h3 class="mt-3 text-center fs-3 fw-bold">My Favourites</h3>
        <div class="row my-5" id="product-section">
            <!-- products -->
                @foreach ($favourites as $favourite)
                <div class="col-12 col-lg-3 col-sm-6">
                    <div class="card m-0">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                        <span class="badge bg-success"> {{$favourite->product->category->name}} </span>
                        <span class="badge bg-warning"> {{$favourite->product->ageGroup->name}}  </span>
                        </div>
                        <div class="text-warning">
                            <form class="d-inline" action="{{url("/toggleFavourite")}}" method="POST">
                                @csrf
                                <input type="text" name="user" value="{{auth()->user()->id}}" class="d-none">
                                <input type="text" name="product" value="{{$favourite->product->id}}" class="d-none">
                                <button type="submit" class="text-warning fs-5 action-btn">
                                    <i class="fas fa-star action-icon"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <a href="{{url("/products/".$favourite->product->slug)}}">
                          <img src="{{asset("/image/".$favourite->product->image)}}" class="img-fluid product-image" alt="" />
                        </a>

                    </div>
                    <div class="card-footer">
                        <p>{{$favourite->product->name}}</p>
                        <div
                        class="d-flex justify-content-between mb-2 align-items-center"
                        >
                        <span
                            ><sup>mmk</sup><strong class="fs-5">{{$favourite->product->price}}</strong></span
                        >
                        </div>
                        <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                            @csrf
                            <input type="text" name="productId" value="{{$favourite->product->id}}" class="d-none" />
                            <button type="submit" class="btn btn-info btn-block m-0">
                                Add to cart
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end my-3">{{$favourites->links()}}</div>
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
        root: document.querySelector('#scrollArea'),
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
