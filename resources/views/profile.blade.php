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
        <a class="nav-link nav-link-me position-relative" href="{{url("/cart")}}"
        >Cart<span></span
        ><span class="badge rounded-pill bg-danger">{{$cart_count}}</span></a
        >
    </li>
    <li class="nav-item">
    <a href="{{url("/profile")}}" class="nav-link nav-link-me active-link">Profile<span></span></a>
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
    <!-- product detail section -->
    <div class="container-fluid py-5" style="background-color: azure">
        <div class="container py-5">
          <div class="card p-5">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-4">
                  <div class="mb-3 position-relative" id="image-container" style="height: auto;">
                      <img src="{{asset("/image/".$user->image)}}" id="user-image" alt="{{$user->image}}" style="width: 100%;height: auto" />
                      <div id="image-upload-btn">
                         <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-danger d-none" role="status" id="spinner">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                             <label for="image-upload-input" id="image-upload-input-wrap">
                                 <input id="image-upload-input" type="file" name="image" class="d-none" />
                                 <div class="d-flex justify-content-center align-items-center bg-white text-black rounded-circle" id="upload-icon" style="width: 2.5rem;height: 2.5rem;">
                                    <i class="fas fa-plus"></i>
                                </div>
                             </label>
                         </div>
                      </div>
                  </div>
                  <hr />
                  <div class="d-flex justify-content-between align-items-start">
                    <span class="fs-3 fw-bold">{{$user->name}}</span>
                  </div>
                  <div class="fs-6 mb-3">{{$user->email}}</div>
                </div>

                <!-- statistics section -->
                <div class="col-12 col-md-8">
                  <div class="d-flex justify-content-between">
                    <div class="fs-5 text-black-50 mb-3">Statistics</div>
                    <div class="fs-6 text-primary"><i>joined {{$user->created_at->diffForHumans()}}</i></div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-12 col-md-4 col-sm-6">
                      <div
                        class="card p-3 d-flex justify-content-between align-items-center flex-row"
                      >
                        <div>
                          <div class="mb-2">Pending Orders</div>
                          <div class="fw-bold fs-5" id="pendingCount">{{$pendingOrderCount}}</div>
                        </div>
                        <div
                          class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center"
                          style="width: 3rem; height: 3rem"
                        >
                          <i class="fas fa-cubes"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6">
                      <div
                        class="card p-3 d-flex justify-content-between align-items-center flex-row"
                      >
                        <div>
                          <div class="mb-2">Complete Orders</div>
                          <div class="fw-bold fs-5" id="completedCount">{{$completedOrderCount}}</div>
                        </div>
                        <div
                          class="rounded-circle bg-success text-white d-flex justify-content-center align-items-center"
                          style="width: 3rem; height: 3rem"
                        >
                          <i class="fas fa-cubes"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6">
                      <div
                        class="card p-3 d-flex justify-content-between align-items-center flex-row"
                      >
                        <div>
                          <div class="mb-2">Favourites</div>
                          <div class="fw-bold fs-5" id="favouriteCount">{{$user->favourites_count}}</div>
                        </div>
                        <div
                          class="rounded-circle bg-warning text-white d-flex justify-content-center align-items-center"
                          style="width: 3rem; height: 3rem"
                        >
                          <i class="fas fa-star"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6">
                      <div
                        class="card p-3 d-flex justify-content-between align-items-center flex-row"
                      >
                        <div>
                          <div class="mb-2">Liked</div>
                          <div class="fw-bold fs-5" id="likeCount">{{$user->likes_count}}</div>
                        </div>
                        <div
                          class="rounded-circle bg-danger text-white d-flex justify-content-center align-items-center"
                          style="width: 3rem; height: 3rem"
                        >
                          <i class="fas fa-heart"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4 col-sm-6">
                      <div
                        class="card p-3 d-flex justify-content-between align-items-center flex-row"
                      >
                        <div>
                          <div class="mb-2">Commented</div>
                          <div class="fw-bold fs-5" id="commentCount">{{$user->comments_count}}</div>
                        </div>
                        <div
                          class="rounded-circle bg-info d-flex text-white justify-content-center align-items-center"
                          style="width: 3rem; height: 3rem"
                        >
                          <i class="fas fa-comment"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- orders list section -->
                  <div class="d-flex justify-content-between">
                    <div class="fs-5 text-black-50 mb-3">Order history</div>
                  </div>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a
                        class="nav-link active order-section"
                        id="home-tab"
                        data-toggle="tab"
                        href="#pending"
                        >Pending</a
                      >
                    </li>
                    <li class="nav-item" role="presentation">
                      <a
                        class="nav-link order-section"
                        id="profile-tab"
                        data-toggle="tab"
                        href="#completed"
                        >Completed</a
                      >
                    </li>
                  </ul>

                  <div class="tab-content my-3" id="myTabContent">
                    <!-- pending orders section -->
                    <div
                      class="tab-pane fade show active"
                      id="pending"
                      role="tabpanel"
                      aria-labelledby="pending-tab"
                    >
                        @if ($pendingOrderCount>0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Order date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingOrders as $pendingOrder)
                                <tr>
                                    <td>
                                    <img
                                        src="{{asset("/image/".$pendingOrder->product->image)}}"
                                        class="order-product-image"
                                        alt="{{$pendingOrder->product->image}}"
                                    />
                                    </td>
                                    <td>{{$pendingOrder->product->name}}</td>
                                    <td>{{$pendingOrder->quantity}}</td>
                                    <td>{{$pendingOrder->created_at->diffForHumans()}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="badge bg-danger">No order yet</div>
                        </div>
                        @endif

                    </div>

                    <!-- completed orders section -->
                    <div
                      class="tab-pane fade"
                      id="completed"
                      role="tabpanel"
                      aria-labelledby="completed-tab"
                    >
                        @if ($completedOrderCount>0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Order date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completedOrders as $completedOrder)
                                    <tr>
                                        <td>
                                        <img
                                            src="{{asset("/image/".$completedOrder->product->image)}}"
                                            class="order-product-image"
                                            alt="{{$completedOrder->product->image}}"
                                        />
                                        </td>
                                        <td>{{$completedOrder->product->name}}</td>
                                        <td>{{$completedOrder->quantity}}</td>
                                        <td>{{$completedOrder->updated_at->diffForHumans()}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                               {{$completedOrders->links()}}
                            </div>

                        @else
                        <div class="d-flex justify-content-center align-items-center">
                             <div class="badge bg-danger">No order yet</div>
                        </div>
                        @endif

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('extra-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js" integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(()=>{
        $("#image-upload-input").change(async()=>{
            const formData = new FormData();
            const imageInput = document.querySelector("#image-upload-input");
            if(imageInput.files[0]){
                if(imageInput.files[0].type === "image/jpeg" || imageInput.files[0].type === "image/jpg" || imageInput.files[0].type === "image/png"){
                    formData.append("image",imageInput.files[0]);
                    $("#image-upload-btn").addClass("d-block");
                    $("#spinner").removeClass("d-none");
                    $("#image-upload-input-wrap").addClass("d-none");
                    const res = await axios.post("{{url("/uploadImage")}}",formData,{
                        headers: {
                            "Content-Type" : "multipart/form-data"
                        }
                    });
                    $("#user-image").attr("src",`${res.data}`);
                    $("#image-upload-btn").removeClass("d-block");
                    $("#spinner").addClass("d-none");
                    $("#image-upload-input-wrap").removeClass("d-none");
                    new Noty({
                    type: "info",
                    layout: "centerRight",
                    text     : "your profile is updated",
                    timeout: 3000,
                    killer: true,
                    }).show();
                }else{
                    new Noty({
                    type: "error",
                    layout: "centerRight",
                    text     : "please choose an image (jpeg,jpg,png)",
                    timeout: 3000,
                    killer: true,
                    }).show();
                }
            }else{
                new Noty({
                type: "error",
                layout: "centerRight",
                text     : "please choose an image",
                timeout: 3000,
                killer: true,
                }).show();
            }
        })

        const datas = {
        pendingCount: 0,
        completedCount: 0,
        favouriteCount: 0,
        likeCount: 0,
        commentCount: 0
        }
        anime({
        targets: datas,
        pendingCount: {{$pendingOrderCount}},
        completedCount: {{$completedOrderCount}},
        favouriteCount: {{$user->favourites_count}},
        likeCount: {{$user->likes_count}},
        commentCount: {{$user->comments_count}},
        easing: 'linear',
        round: 1,
        update: function() {
            document.querySelector('#pendingCount').innerHTML = datas.pendingCount;
            document.querySelector('#completedCount').innerHTML = datas.completedCount;
            document.querySelector('#favouriteCount').innerHTML = datas.favouriteCount;
            document.querySelector('#likeCount').innerHTML = datas.likeCount;
            document.querySelector('#commentCount').innerHTML = datas.commentCount;
        }
        });
    });
</script>
@endsection
