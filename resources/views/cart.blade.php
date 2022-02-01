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
        ><span class="badge rounded-pill bg-danger" id="cart-count">{{$cart_count}}</span></a
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
        <div class="d-md-flex d-block justify-content-between mb-3 align-items-center cart-product-card">
            <div class="d-flex align-items-center justify-content-center">
                <img
                    src="{{asset("/image/".$productInCart->product->image)}}"
                    class="cart-product-image img-fluid"
                    alt=""
                />
                <div class="ms-4">
                    <h3 class="mb-3 fs-5">{{$productInCart->product->name}}</h3>
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
                {{-- <form action="{{url("/cart/remove")}}" method="POST" class="d-inline m-0 p-0">
                    @csrf
                    <input type="text" name="productId" value="{{$productInCart->product->id}}" class="d-none" />
                    <button type="submit" class="btn btn-outline-primary mx-0 disabled">-</button>
                </form> --}}
                <button class="btn btn-outline-primary mx-0 cartRemoveBtn" data-product-id="{{$productInCart->product->id}}" data-product-price="{{$productInCart->product->price}}">
                    <span class="spinner-border spinner-border-sm text-white d-none"></span>
                    <span>-</span>
                </button>
                <button
                  class="btn btn-primary mx-0"
                  style="pointer-events: none"
                >
                  <span class="">{{$productInCart->quantity}}</span>
                  <span class="spinner-border-sm spinner-border text-white d-none"></span>
                  </button
                >
                {{-- <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                    @csrf
                    <input type="text" name="productId" value="{{$productInCart->product->id}}" class="d-none" />
                    <button type="submit" class="btn btn-outline-primary mx-0 disabled">+</button>
                </form> --}}
                <button class="btn btn-outline-primary mx-0 cartAddBtn" data-product-id="{{$productInCart->product->id}}" data-product-price="{{$productInCart->product->price}}">
                    <span class="spinner-border spinner-border-sm text-white d-none"></span>
                    <span>+</span>
                </button>

              </div>
            </div>
          </div>
          <?php
          $totalItems += $productInCart->quantity;
          $totalPrice += $productInCart->quantity*$productInCart->product->price;
          ?>
        @endforeach
        @else
        <div class="d-flex justify-content-center align-items-center flex-column" id="no-product-cart">
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
                    <span id="total-item" class="badge bg-danger position-absolute border-light translate-middle rounded-pill start-100 d-inline-block" style="font-size: .8rem;border-width: 3px;z-index: 5;">
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
              ><span class="fw-bold fs-3" id="total-price">{{$totalPrice}}</span></span
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

    const cartAddBtns = document.querySelectorAll(".cartAddBtn");
    const cartRemoveBtns = document.querySelectorAll(".cartRemoveBtn");
    const cartCount = document.getElementById("cart-count");
    const totalItem = document.getElementById("total-item");
    const totalPrice = document.getElementById("total-price");

    const datas = {
        totalPrice: 0,
        totalItem: 0
        };

    cartAddBtns.forEach(cartAddBtn => {
        cartAddBtn.addEventListener("click",async(e)=>{
            const minusBtn = $(e.target).parent().find("button:nth-child(1)");
            const plusBtn = $(e.target).parent().find("button:nth-child(3)");
            const countBtn = $(e.target).parent().find("button:nth-child(2)");
            const spinner = countBtn.find("span:nth-child(2)");
            const itemCount = countBtn.find("span:nth-child(1)");
            const formData = new FormData();
            const cartCountText = Number(cartCount.innerHTML);
            const totalItemText = Number(totalItem.innerHTML);
            const previousTotalPrice = Number(totalPrice.innerHTML);
            const perPrice = Number(e.target.dataset.productPrice);
            const itemCountText = Number(itemCount.html());
            // console.log(itemCountText);
            // return;
            formData.append("productId",e.target.dataset.productId);
            spinner.removeClass("d-none");
            itemCount.addClass("d-none");
            minusBtn.addClass("disabled");
            plusBtn.addClass("disabled");
            countBtn.addClass("disabled");
            const {data} = await axios.post("{{url("/cart/add")}}",formData);
            if(data.success){
                new Noty({
                type: "info",
                layout: "centerRight",
                text     : data.success,
                timeout: 3000,
                killer: true,
                }).show();
                spinner.addClass("d-none");
                itemCount.removeClass("d-none");
                cartCount.innerHTML = String(cartCountText+1);
                cartCount.classList.add("larger");
                itemCount.html(String(itemCountText+1));
                // totalItem.classList.add("larger");
                totalItem.innerHTML = String(totalItemText + 1);
                // totalPrice.innerHTML = String(previousTotalPrice + perPrice);
                anime({
                targets: ".larger",
                scale: [2,1],
                duration: 200
                });
                anime({
                targets: datas,
                totalPrice: String(previousTotalPrice + perPrice),
                easing: 'linear',
                round: 1,
                duration: 200,
                update: function() {
                    totalPrice.innerHTML = datas.totalPrice;
                }
                });
                setTimeout(() => {
                    cartCount.classList.remove("larger");
                }, 200);
            }else{
                new Noty({
                type: "error",
                layout: "centerRight",
                text     : data.error,
                timeout: 3000,
                killer: true,
                }).show();
                spinner.addClass("d-none");
                itemCount.removeClass("d-none");
            }
            setTimeout(() => {
            minusBtn.removeClass("disabled");
            plusBtn.removeClass("disabled");
            countBtn.removeClass("disabled");
            }, 300);

        });
    });

    cartRemoveBtns.forEach(cartRemoveBtn => {
        cartRemoveBtn.addEventListener("click",async(e)=>{
            console.log($(e.target).parent().parent().parent());
            const minusBtn = $(e.target).parent().find("button:nth-child(1)");
            const plusBtn = $(e.target).parent().find("button:nth-child(3)");
            const countBtn = $(e.target).parent().find("button:nth-child(2)");
            const spinner = countBtn.find("span:nth-child(2)");
            const itemCount = countBtn.find("span:nth-child(1)");
            const formData = new FormData();
            const cartCountText = Number(cartCount.innerHTML);
            const totalItemText = Number(totalItem.innerHTML);
            const previousTotalPrice = Number(totalPrice.innerHTML);
            const perPrice = Number(e.target.dataset.productPrice);
            const itemCountText = Number(itemCount.html());
            // console.log(itemCountText);
            // return;
            formData.append("productId",e.target.dataset.productId);
            spinner.removeClass("d-none");
            itemCount.addClass("d-none");
            minusBtn.addClass("disabled");
            plusBtn.addClass("disabled");
            countBtn.addClass("disabled");
            const {data} = await axios.post("{{url("/cart/remove")}}",formData);
            if(data.success){
                new Noty({
                type: "info",
                layout: "centerRight",
                text     : data.success,
                timeout: 3000,
                killer: true,
                }).show();
                spinner.addClass("d-none");
                itemCount.removeClass("d-none");
                cartCount.innerHTML = String(cartCountText-1);
                cartCount.classList.add("larger");
                itemCount.html(String(itemCountText-1));
                // totalItem.classList.add("larger");
                totalItem.innerHTML = String(totalItemText - 1);
                // totalPrice.innerHTML = String(previousTotalPrice + perPrice);
                anime({
                targets: ".larger",
                scale: [2,1],
                duration: 200
                });
                anime({
                targets: datas,
                totalPrice: String(previousTotalPrice - perPrice),
                easing: 'linear',
                round: 1,
                duration: 200,
                update: function() {
                    totalPrice.innerHTML = datas.totalPrice;
                }
                });
                setTimeout(() => {
                    cartCount.classList.remove("larger");
                }, 200);
                if(itemCountText === 1){
                  $(e.target).parent().parent().parent().addClass("removed");
                  anime({
                    targets: ".removed",
                    translateX: [0,-500],
                    opacity: [1,0],
                    duration: 300
                  });

                  if((totalItemText-1) === 0){
                    $("#product-section").html(`
                    <div class="d-flex justify-content-center align-items-center flex-column" id="no-product-cart">
                    <span class="badge bg-danger">No item yet</span>
                    <a href="{{url("/#product-section")}}" class="btn btn-link">Add now</a>
                    {{-- <span class="badge bg-danger">No item yet</span> --}}
                    </div>
                    `);
                }

                  setTimeout(() => {
                    $(".removed").attr("class","d-none");
                  }, 300);
                  return;
                }
                // console.log(totalItemText);
            }else{
                new Noty({
                type: "error",
                layout: "centerRight",
                text     : data.error,
                timeout: 3000,
                killer: true,
                }).show();
                spinner.addClass("d-none");
                itemCount.removeClass("d-none");
            }
            setTimeout(() => {
            minusBtn.removeClass("disabled");
            plusBtn.removeClass("disabled");
            countBtn.removeClass("disabled");
            }, 300);

        });
    });

    anime({
        targets: "#cart-icon",
        translateX: [-300,0],
        opacity: [0,1],
        rotate: "3turn"
    });

    anime({
    targets: datas,
    totalPrice: {{$totalPrice}},
    easing: 'linear',
    round: 1,
    update: function() {
        document.querySelector('#total-price').innerHTML = datas.totalPrice;
    }
    });
});

</script>
@endsection
