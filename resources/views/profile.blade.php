@extends('layout.master')
@section('content')
    <!-- product detail section -->
    <div class="container-fluid py-5" style="background-color: azure">
        <div class="container py-5">
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="card p-5 position-sticky px-3" style="top: 6rem">
                <div class="card-body">
                  <img src="./menPorduct.jpg" alt="" class="img-fluid" />
                </div>
                <div
                  class="card-footer d-flex justify-content-between align-items-center"
                >
                  <div class="fs-5 text-danger">
                    <i class="far fa-heart action-icon"></i>
                    <small class="ms-1">34</small>
                  </div>
                  <div class="fs-5 text-warning">
                    <i class="far fa-star action-icon"></i>
                    <small class="ms-1">Add to favourites</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-8">
              <div class="card p-5">
                <div class="mb-4">
                  <h3 class="fs-1 fw-bold mb-2">Nike's Long Sleeve Shirt</h3>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Cupiditate esse tenetur repellat. Laborum, enim commodi
                    quibusdam inventore repellendus eligendi sed vero odio fuga
                    sequi, officiis amet asperiores libero dicta. Modi.
                  </p>
                </div>
                <div class="mb-3">
                  <span class="fs-2 fw-bold mb-4">15000<sup>mmk</sup></span>
                  <div>
                    <button class="btn btn-primary">Add to cart</button>
                    <button class="btn btn-outline-primary">see more</button>
                  </div>
                </div>
                <div class="mb-2">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">Category: </span>
                  <span class="fs-6 fw-bold">Shrit </span>
                </div>
                <div class="mb-2">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">AgeGroup: </span>
                  <span class="fs-6 fw-bold">Man </span>
                </div>
                <div class="mb-2">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">Views: </span>
                  <span class="fs-6 fw-bold">69 </span>
                </div>
                <div class="mb-5">
                  <i class="fas fa-check me-2"></i>
                  <span class="fs-6">Likes: </span>
                  <span class="fs-6 fw-bold">60 </span>
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
                  >
                    <div class="d-flex align-items-start mb-3">
                      <img
                        src="./menPorduct.jpg"
                        class="cmt-profile rounded-circle"
                        alt=""
                      />
                      <div
                        class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
                        style="background-color: azure"
                      >
                        <div class="title d-flex">
                          <span class="fs-5 fw-bold">Thethan</span>
                          <span class="fw-lighter ms-2"
                            ><small>3 days ago</small></span
                          >
                        </div>
                        <div>Lorem ipsum dolor</div>
                      </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                      <img
                        src="./menPorduct.jpg"
                        class="cmt-profile rounded-circle"
                        alt=""
                      />
                      <div
                        class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
                        style="background-color: azure"
                      >
                        <div class="title d-flex">
                          <span class="fs-5 fw-bold">Thethan</span>
                          <span class="fw-lighter ms-2"
                            ><small>3 days ago</small></span
                          >
                        </div>
                        <div>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit.
                          Quia voluptatibus culpa itaque voluptatem!
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                      <img
                        src="./menPorduct.jpg"
                        class="cmt-profile rounded-circle"
                        alt=""
                      />
                      <div
                        class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
                        style="background-color: azure"
                      >
                        <div class="title d-flex">
                          <span class="fs-5 fw-bold">Thethan</span>
                          <span class="fw-lighter ms-2"
                            ><small>3 days ago</small></span
                          >
                        </div>
                        <div>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit.
                          Quia voluptatibus culpa itaque voluptatem!
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                      <img
                        src="./menPorduct.jpg"
                        class="cmt-profile rounded-circle"
                        alt=""
                      />
                      <div
                        class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
                        style="background-color: azure"
                      >
                        <div class="title d-flex">
                          <span class="fs-5 fw-bold">Thethan</span>
                          <span class="fw-lighter ms-2"
                            ><small>3 days ago</small></span
                          >
                        </div>
                        <div>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit.
                          Quia voluptatibus culpa itaque voluptatem!
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                      <a href="#" class="btn btn-link m-0">view more</a>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="d-flex align-items-start">
                      <img
                        src="./menPorduct.jpg"
                        class="cmt-profile-me rounded-circle"
                        alt=""
                      />
                      <div
                        class="flex-grow-1 p-2 rounded-3 text-black shadow-4 ms-2"
                      >
                        <input
                          type="text"
                          class="form-control p-3"
                          placeholder="write some comment..."
                        />
                        <button class="btn btn-primary btn-sm">Comment</button>
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
