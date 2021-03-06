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
        ><span class="badge rounded-pill bg-danger" id="cartCount">{{$cart_count}}</span></a
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
    <!-- product detail section -->
    <div class="container-fluid py-5 position-relative" style="background-color: azure" id="detail-section">
        <div class="container py-5">
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="card p-5 position-sticky px-3" style="top: 6rem">
                <div class="card-body d-flex justify-content-center">
                  <img src="{{asset("image/".$product->image)}}" alt="" class="img-fluid" />
                </div>
                <div
                  class="card-footer d-flex justify-content-between align-items-center"
                >
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
                      @if ($isFavourite)
                        <small class="ms-1 text-black-50 favourite-status">Favourite</small>
                      @else
                         <small class="ms-1 text-black-50 favourite-status">Add to favourites</small>
                      @endif
                </div>

                </div>
              </div>
            </div>
            <div class="col-12 col-md-8">
              <div class="card p-md-5 p-3">
                <div class="mb-4">
                  <h3 class="fs-1 fw-bold mb-2">{{$product->name}}</h3>
                  <p>
                    {{$product->description}}
                  </p>
                </div>
                <div class="mb-3">
                  <span class="fs-2 fw-bold mb-4">{{$product->price}}<sup>mmk</sup></span>
                  <div>
                    {{-- <form action="{{url("/cart/add")}}" method="POST" class="d-inline m-0 p-0">
                        @csrf
                        <input type="text" name="productId" value="{{$product->id}}" class="d-none" />
                        <button type="submit" class="btn btn-danger fs-5">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </form> --}}
                    <span class="btn btn-danger cartAddBtn" data-product-id="{{$product->id}}">
                        <span class="spinner-border spinner-border-sm text-white d-none"></span>
                        <span>Add to cart</span>
                    </span>
                    <a href="{{url("/#product-section")}}" class="btn btn-outline-danger">see more</a>
                  </div>
                </div>
                <div class="mb-2">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">Category: </span>
                  <span class="fs-6 fw-bold">{{$product->category->name}}</span>
                </div>
                <div class="mb-2">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">AgeGroup: </span>
                  <span class="fs-6 fw-bold">{{$product->ageGroup->name}}</span>
                </div>
                <div class="mb-2">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">Views: </span>
                  <span class="fs-6 fw-bold">{{$product->view_count}}</span>
                </div>
                <div class="mb-5">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">Likes: </span>
                  <span class="fs-6 fw-bold">{{$product->likes_count? $product->likes_count : 0}}</span>
                </div>
                <ul class="list-group-flush mx-0 px-0">
                  <li
                    class="list-group-item active bg-primary"
                    style="border-color: #2ba9cd !important"
                  >
                    Comments
                  </li>
                  <li
                    class="list-group-item p-3"
                    style="max-height: 20rem; overflow-y: auto"
                    id= "comment-section"
                  >
                    @foreach ($product->comments as $comment)
                    @if ($comment->user->id === auth()->user()->id)
                    <div class="comment-wrapper">
                        <div class="d-flex mb-3 comment-super-wrap">
                            <div class="d-flex align-items-start">
                                <img
                                src="{{asset("image/".$comment->user->image)}}"
                                class="cmt-profile rounded-circle"
                                alt="{{$comment->user->image}}"
                                />
                                <div class="rounded-3 position-relative flex-grow-1 p-0 ms-2 overflow-hidden comment-wrap">
                                    <div class="position-absolute w-100 h-100 p3 delete-btn-wrap" style="background-color: #0003">
                                        <span class="d-inline-block ms-auto my-2 me-2 d-flex justify-content-center align-items-center shadow-3 rounded-circle bg-white text-black delete-cmt-btn" style="width: 2rem;height: 2rem;" data-comment-id="{{$comment->id}}">
                                            <i style="pointer-events: none" class="fas fa-times"></i>
                                        </span>
                                    </div>
                                    <div
                                    class="flex-grow-1 p-2 rounded-3 text-black"
                                    style="background-color: lightyellow"
                                    >
                                        <div class="title d-flex justify-content-between align-items-center">
                                            <span class="fs-6 fw-bold">You &middot; <span class="text-black-50" style="font-size: .8rem">{{$comment->user->name}}</span></span>
                                            <span class="fw-lighter ms-2"
                                            ><i><small class="text-black-50">{{$comment->created_at->diffForHumans()}}</small></i></span
                                            >
                                        </div>
                                        <div>{{$comment->comment}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="comment-wrapper">
                        <div class="d-flex">
                            <div class="d-flex align-items-start mb-3">
                                <img
                                src="{{asset("image/".$comment->user->image)}}"
                                class="cmt-profile rounded-circle"
                                alt="{{$comment->user->image}}"
                                />
                                <div
                                class="flex-grow-1 p-2 rounded-3 text-black ms-2"
                                style="background-color: azure"
                                >
                                <div class="title d-flex justify-content-between align-items-center">
                                    <span class="fs-6 fw-bold">{{$comment->user->name}}</span>
                                    <span class="fw-lighter ms-2"
                                    ><i><small class="text-black-50">{{$comment->created_at->diffForHumans()}}</small></i></span
                                    >
                                </div>
                                <div>{{$comment->comment}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach
                    {{-- view more --}}
                    {{-- <div class="d-flex align-items-start mb-3">
                      <a href="#" class="btn btn-link m-0">view more</a>
                    </div> --}}
                  </li>

                  <li class="list-group-item">
                    <div class="d-flex align-items-start">
                      <img
                        src="{{asset("image/".auth()->user()->image)}}"
                        class="cmt-profile-me rounded-circle shadow-4"
                        alt=""
                      />
                      <div
                        class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
                      >
                        <input
                          type="text"
                          name="newComment"
                          class="form-control p-3"
                          placeholder="write some comment..."
                          id="new-comment"
                          required
                        />
                        <button class="btn btn-primary btn-sm" id="comment-btn">Comment</button>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- product detail section -->
@endsection
@section('extra-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js" integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$(()=>{
const newComment = document.getElementById("new-comment");
const commentBtn = document.getElementById("comment-btn");
const commentSection = document.getElementById("comment-section");
const deleteBtns = document.getElementsByClassName("delete-cmt-btn");
const commentWrappers = document.querySelectorAll(".comment-wrapper");
const favouriteBtn = document.querySelector(".favouriteBtn");
const likeBtn = document.querySelector(".likeBtn");
const cartAddBtn = document.querySelector(".cartAddBtn");

Array.prototype.forEach.call(deleteBtns,(deleteBtn)=>{
    deleteBtn.addEventListener("click",async(e)=>{
    let formData = new FormData();
    formData.append("commentId",e.target.dataset.commentId);
    const res = await axios.post("{{url("/removeComment")}}",formData);
    if(res.data.error){
        new Noty({
        type: "warning",
        layout: "centerRight",
        text     : res.data.error,
        timeout: 3000,
        killer: true,
        }).show();
    }else{
     $(e.target).parents(".comment-super-wrap").remove();
     new Noty({
        type: "info",
        layout: "centerRight",
        text     : "comment removed",
        timeout: 3000,
        killer: true,
        }).show();
    }
});
});

commentBtn.addEventListener("click",async()=>{
let formData = new FormData();
formData.append("newComment",newComment.value);
formData.append("user",{{auth()->user()->id}});
formData.append("product",{{$product->id}});
const res = await axios.post("{{url("/createComment")}}",formData);
console.log(res.data);
if(res.data.error){
    new Noty({
    type: "error",
    layout: "centerRight",
    text     : res.data.error,
    }).show();
}
else if(res.data.success){
    const createdComment = res.data.success;
    const comment = document.createElement("div");
    comment.classList = "d-flex mb-3 comment-super-wrap";
    comment.innerHTML = `
                <div class="d-flex align-items-start">
                    <img
                    src="{{asset("image/".auth()->user()->image)}}"
                    class="cmt-profile rounded-circle"
                    alt="{{auth()->user()->image}}"
                    />
                    <div class="rounded-3 position-relative flex-grow-1 p-0 ms-2 overflow-hidden comment-wrap">
                        <div class="position-absolute w-100 h-100 p3 delete-btn-wrap" style="background-color: #0003">
                            <span class="d-inline-block ms-auto my-2 me-2 d-flex justify-content-center align-items-center shadow-3 rounded-circle bg-white text-black delete-cmt-btn" data-comment-id=${createdComment.id} style="width: 2rem;height: 2rem;">
                                <i class="fas fa-times"></i>
                            </span>
                        </div>
                        <div
                        class="flex-grow-1 p-2 rounded-3 text-black"
                        style="background-color: lightyellow"
                        >
                            <div class="title d-flex justify-content-between align-items-center">
                                <span class="fs-6 fw-bold">You &middot; <span class="text-black-50" style="font-size: .8rem">{{auth()->user()->name}}</span></span>
                                <span class="fw-lighter ms-2"
                                ><i><small class="text-black-50">{{now()->diffForHumans()}}</small></i></span
                                >
                            </div>
                            <div>${createdComment.comment}</div>
                        </div>
                    </div>
                </div>`;
commentSection.prepend(comment);
document.querySelector(".delete-cmt-btn").addEventListener("click",async(e)=>{
    let formData = new FormData();
    formData.append("commentId",createdComment.id);
    const res = await axios.post("{{url("/removeComment")}}",formData);
    if(res.data.error){
        new Noty({
        type: "warning",
        layout: "centerRight",
        text     : res.data.error,
        timeout: 3000,
        killer: true,
        }).show();
    }else{
     $(e.target).parents(".comment-super-wrap").remove();
     new Noty({
        type: "info",
        layout: "centerRight",
        text     : "comment removed",
        timeout: 3000,
        killer: true,
        }).show();
    }
});
newComment.value = "";
new Noty({
type: "info",
layout: "centerRight",
text     : "comment created",
timeout: 3000,
killer: true,
}).show();
comment.scrollIntoView({behavior: "smooth",alignToTop: true});
}
});


favouriteBtn.addEventListener("click",async(e)=>{
    const formData = new FormData();
    formData.append("product",e.target.dataset.productId);
    const spinner = e.target.children[0];
    spinner.classList.remove("d-none");
    const starIcon = e.target.querySelector("i");
    starIcon.classList.add("d-none");
    const {data}= await axios.post("{{url("/toggleFavourite")}}",formData);
    spinner.classList.add("d-none");
    if(data.success.slice(0,7) === "removed"){
        starIcon.classList = "far fa-star";
        e.target.nextElementSibling.innerHTML = "Add to favourites";
    }else if(data.success.slice(0,5) === "added"){
        starIcon.classList = "fas fa-star";
        e.target.nextElementSibling.innerHTML = "Favourites";
    }
    else{
        new Noty({
        type: "error",
        layout: "centerRight",
        text     : data.error,
        timeout: 3000,
        killer: true,
        }).show();
        return;
    }
    new Noty({
    type: "info",
    layout: "centerRight",
    text     : data.success,
    timeout: 3000,
    killer: true,
    }).show();

});

likeBtn.addEventListener("click",async(e)=>{
    const formData = new FormData();
    formData.append("product",e.target.dataset.productId);
    const spinner = e.target.children[0];
    spinner.classList.remove("d-none");
    const likeIcon = e.target.querySelector("i");
    likeIcon.classList.add("d-none");
    const {data}= await axios.post("{{url("/toggleLike")}}",formData);
    spinner.classList.add("d-none");
    const likeIndicator = e.target.nextElementSibling;
    const likeCount = Number(likeIndicator.innerHTML);
    if(data.success.slice(0,7) === "unliked"){
        likeIcon.classList = "far fa-heart";
        likeIndicator.innerHTML = String(likeCount-1);
    }else if(data.success.slice(0,5) === "liked"){
        likeIcon.classList = "fas fa-heart";
        likeIndicator.innerHTML = String(likeCount+1);
    }
    else{
        new Noty({
        type: "error",
        layout: "centerRight",
        text     : data.error,
        timeout: 3000,
        killer: true,
        }).show();
        return;
    }
    new Noty({
    type: "info",
    layout: "centerRight",
    text     : data.success,
    timeout: 3000,
    killer: true,
    }).show();

});

cartAddBtn.addEventListener("click",async(e)=>{
    const spinner = e.target.children[0];
    const btnText = e.target.children[1];
    const formData = new FormData();
    const cartCountText = Number(cartCount.innerHTML);
    formData.append("productId",e.target.dataset.productId);
    spinner.classList.remove("d-none");
    btnText.classList.add("d-none");
    e.target.classList.add("disabled");
    const {data} = await axios.post("{{url("/cart/add")}}",formData);
    if(data.success){
        new Noty({
        type: "info",
        layout: "centerRight",
        text     : data.success,
        timeout: 3000,
        killer: true,
        }).show();
        cartCount.innerHTML = String(cartCountText+1);
        cartCount.classList.add("larger");
        anime({
        targets: ".larger",
        scale: [2,1],
        duration: 200
        });
        setTimeout(() => {
            cartCount.classList.remove("larger");
        }, 300);
    }else{
        new Noty({
        type: "error",
        layout: "centerRight",
        text     : data.error,
        timeout: 3000,
        killer: true,
        }).show();
    }
    spinner.classList.add("d-none");
    btnText.classList.remove("d-none");
    e.target.classList.remove("disabled");
        });

});


</script>
@endsection
