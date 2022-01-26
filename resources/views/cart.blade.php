@extends('layout.master2')
@section('nav-items')
<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link nav-link-me" aria-current="page" href="{{url("/")}}"
          >Home<span></span
        ></a>
    </li>
    @auth
    <li class="nav-item">
        <a class="nav-link nav-link-me" href="{{url("/favourites#product-section")}}"
        >Favourites<span></span
        ></a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-me position-relative active-link" href="{{url("/cart")}}"
        >Cart<span></span
        ><span class="badge rounded-pill bg-danger">{{$cart_count}}</span></a
        >
    </li>
    <li class="nav-item">
    <a href="{{url("/profile")}}" class="nav-link nav-link-me">Profile<span></span></a>
    </li>
    <li class="nav-item">
    <a href="{{url("/signout")}}" class="nav-link nav-link-me">Signout<span></span></a>
    </li>
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
@endsection
@section('content')
<div
class="container-fluid position-relative"
style="
  background-color: ghostwhite;
  padding-top: 8rem;
  padding-bottom: 3rem;
  z-index: 1;
"
>
<div class="container" style="min-height: 80vh">
  <div class="row">
    <div class="col-12 col-lg-9">
      <div class="card bg-white vh-50 p-4" id="product-section">
        <?php
        $totalItems = 0;$totalPrice = 0;
            ?>
        @if (count($productsInCart)>0)
        @foreach ($productsInCart as $productInCart)
        <div class="d-md-flex d-block justify-content-between mb-3 align-items-center">
            <div class="d-flex align-items-center justify-content-center">
                <img
                    src="{{asset("/image/".$productInCart->product->image)}}"
                    class="cart-product-image img-fluid"
                    alt=""
                />
                <div class="ms-4">
                    <h3 class="mb-3">{{$productInCart->product->name}}</h3>
                    <div class="mb-3">
                    <span class="mb-2">
                        Category: <span class="fw-bold">{{$productInCart->product->category->name}}</span></span
                    >
                    <br />
                    <span> AgeGroup: <span class="fw-bold">{{$productInCart->product->ageGroup->name}}</span> </span>
                    <br />
                    <span
                        >Price:
                        <span
                        ><sup>mmk</sup
                        ><span class="fw-bold">{{$productInCart->product->price}}</span></span
                        ></span
                    >
                    </div>
                </div>
            </div>
            <div
              class="d-md-flex justify-content-between align-items-center p-5 d-block"
            >
              <div class="btn-group shadow-0">
                <form action="{{url("/cart/remove")}}" method="POST" class="d-inline m-0 p-0">
                    @csrf
                    <input type="text" name="productId" value="{{$productInCart->product->id}}" class="d-none" />
                    <button type="submit" class="btn btn-outline-primary mx-0">-</button>
                </form>
                <button
                  class="btn btn-primary mx-0"
                  style="pointer-events: none"
                >
                  {{$productInCart->quantity}}</button
                >
                <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                    @csrf
                    <input type="text" name="productId" value="{{$productInCart->product->id}}" class="d-none" />
                    <button type="submit" class="btn btn-outline-primary mx-0">+</button>
                </form>

              </div>
            </div>
          </div>
          <?php
          $totalItems += $productInCart->quantity;
          $totalPrice += $productInCart->quantity*$productInCart->product->price;
          ?>
        @endforeach
        @else
        <div class="d-flex justify-content-center align-items-center flex-column">
            <span class="badge bg-danger">No item yet</span>
            <a href="{{url("/#product-section")}}" class="btn btn-link">Add now</a>
            {{-- <span class="badge bg-danger">No item yet</span> --}}
        </div>
        @endif
      </div>
    </div>

    <!-- aside -->
    <aside class="col-12 col-lg-3 order-first order-lg-last">
      <div class="position-sticky" style="top: 5rem">
        <div
          class="card p-4 d-flex flex-row justify-content-between align-items-center"
        >
            <div class="fs-5 position-relative">
                <div class="position-relative bg-0">
                    <span id="item-count" class="badge bg-danger position-absolute border-light translate-middle rounded-pill start-100 d-inline-block" style="font-size: .8rem;border-width: 3px;z-index: 5;">
                        {{$totalItems}}
                    </span>
                    <span>
                        <i class="fas fa-shopping-cart fa-2x" id="cart-icon"></i>
                    </span>
                </div>
            </div>
            <div class="fs-5">Total items</div>
        </div>
        <div class="card p-4">
          <div
            class="d-flex justify-content-between mb-3 align-items-center"
          >
            <span class="fs-5">Total</span>
            <span
              ><sup>mmk</sup
              ><span class="fw-bold fs-3" id="totalPrice">{{$totalPrice}}</span></span
            >
          </div>
          <a href="{{url("/#product-section")}}" class="btn btn-primary m-0 mb-2">Add More</a>
          <a href="{{url("/makeOrder")}}"  class="btn btn-outline-primary m-0">Make Order</a>
        </div>
      </div>
    </aside>
  </div>
</div>
</div>
@endsection
@section('extra-script')
<script>
$(()=>{
    anime({
        targets: "#cart-icon",
        translateX: [-300,0],
        opacity: [0,1],
        rotate: "3turn"
    });

    const datas = {
        totalPrice: 0
        };
    anime({
    targets: datas,
    totalPrice: {{$totalPrice}},
    easing: 'linear',
    round: 1,
    update: function() {
        document.querySelector('#totalPrice').innerHTML = datas.totalPrice;
    }
    });
});

</script>
@endsection
