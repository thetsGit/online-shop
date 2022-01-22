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
                    <div class="d-flex align-items-start mb-3">
                        <img
                          src="{{asset("image/".$comment->user->image)}}"
                          class="cmt-profile rounded-circle"
                          alt="{{$comment->user->image}}"
                        />
                        <div
                          class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
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
                        class="cmt-profile-me rounded-circle"
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
const formData = new FormData();
    commentBtn.addEventListener("click",async()=>{
    formData.append("newComment",newComment.value);
    formData.append("user",{{auth()->user()->id}});
    formData.append("product",{{$product->id}});
    const res = await axios.post("{{url("/createComment")}}",formData);
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
        comment.classList = "d-flex align-items-start mb-3";
           comment.innerHTML = `
            <img
            src="{{asset("image/".auth()->user()->image)}}"
            class="cmt-profile rounded-circle"
            alt="{{auth()->user()->image}}"
            />
            <div
            class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
            style="background-color: azure"
            >
            <div class="title d-flex justify-content-between align-items-center">
            <span class="fs-6 fw-bold">{{auth()->user()->name}}</span>
            <span class="fw-lighter ms-2"
            ><small><i class="text-black-50">{{now()->diffForHumans()}}</i></small></span
            >
            </div>
            <div>${createdComment.comment}</div>
            </div>
            `;
        commentSection.prepend(comment);
        newComment.value = "";
        new Noty({
        type: "success",
        layout: "centerRight",
        text     : "comment successfully created",
        }).show();
        comment.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
    }
});
});



</script>
@endsection
