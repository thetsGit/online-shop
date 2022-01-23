@extends('layout.master2')
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
      </div>
    </div>

    <!-- aside -->
    <aside class="col-12 col-lg-3 order-first order-lg-last">
      <div class="position-sticky" style="top: 5rem">
        <div
          class="card p-4 d-flex flex-row justify-content-between align-items-center"
        >
          <div class="fs-5">Total items</div>
          <div class="fs-5 position-relative">
            <span class="badge bg-danger fs-6">
                {{$totalItems}}
            </span>
          </div>
        </div>
        <div class="card p-4">
          <div
            class="d-flex justify-content-between mb-3 align-items-center"
          >
            <span class="fs-5">Total</span>
            <span
              ><sup>mmk</sup
              ><span class="fw-bold fs-3">{{$totalPrice}}</span></span
            >
          </div>
          <button class="btn btn-primary m-0 mb-2">Add More</button>
          <button class="btn btn-outline-primary m-0">Make Order</button>
        </div>
      </div>
    </aside>
  </div>
</div>
</div>
@endsection
@section('cart-script')
@if (session("error")||session("success"))
<script>
    new Noty({
    type: "{{session("error")?"error":"info"}}",
    layout: "centerRight",
    text     : "{{session("error")?session("error"):session("success")}}",
    timeout: 3000,
    killer: true,
    }).show();
</script>
@endif
@endsection
