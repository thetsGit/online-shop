@extends('layout.master2')
@section('content')
    <!-- product detail section -->
    <div class="container-fluid py-5 position-relative" style="background-color: azure" id="detail-section">
        <div class="container py-5">
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="card p-5 position-sticky px-3" style="top: 6rem">
                <div class="card-body">
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
                      @if ($isFavourite)
                        <small class="ms-1 text-black-50">Favourite</small>
                      @else
                         <small class="ms-1 text-black-50">Add to favourites</small>
                      @endif
                </div>

                </div>
              </div>
            </div>
            <div class="col-12 col-md-8">
              <div class="card p-5">
                <div class="mb-4">
                  <h3 class="fs-1 fw-bold mb-2">{{$product->name}}</h3>
                  <p>
                    {{$product->description}}
                  </p>
                </div>
                <div class="mb-3">
                  <span class="fs-2 fw-bold mb-4">{{$product->price}}<sup>mmk</sup></span>
                  <div>
                    <button class="btn btn-primary">Add to cart</button>
                    <button class="btn btn-outline-primary">see more</button>
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
                    @else
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
@section('comment-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js" integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$(()=>{
const newComment = document.getElementById("new-comment");
const commentBtn = document.getElementById("comment-btn");
const commentSection = document.getElementById("comment-section");
const deleteBtns = document.getElementsByClassName("delete-cmt-btn");
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

// const deleteCommentHandler = (cmdId)=>{
//     console.log("hello");
// }
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
});



</script>
@endsection
