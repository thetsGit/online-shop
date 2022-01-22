<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Savannah</title>
    {{-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    /> --}}
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      rel="stylesheet"
      href="{{asset("/css/paper-dashboard.min.css")}}"
    />
    <!-- <link rel="stylesheet" href="./argon.min.css" /> -->
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&family=Lobster&family=Pacifico&family=Titillium+Web&display=swap");
      html{
          scroll-behavior: smooth;
      }
      #hero {
        /* background-image: url("/image/static/heroImg3.jpg"); */
        background-position: top;
        background-size: cover;
        height: max(48vw, 30rem);
        position: relative;
      }
      .block {
        width: 100%;
        height: 5rem;
        background-color: yellowgreen;
      }
      body {
        font-family: "Titillium Web", sans-serif;
        margin: 0;
        padding: 0;
      }
      body * {
        box-sizing: border-box;
      }
      .image {
        object-fit: cover;
        object-position: center;
      }
      .creator-link {
        text-decoration: none;
        cursor: pointer;
      }
      .creator-link:hover {
        opacity: 0.5;
        text-decoration: underline;
      }
      #navbar-brand {
        font-family: "Lobster", cursive;
      }
      .nav-link-me {
        position: relative;
        opacity: 1 !important;
      }
      .nav-link-me > span:first-child {
        position: absolute;
        bottom: 0;
        width: 0;
        height: 3px;
        left: 50%;
        transform: translateX(-50%);
        transition: ease 0.5s;
      }
      .nav-link-me:hover {
        opacity: 1 !important;
        color: #2ba9cd !important;
      }
      .nav-link-me:hover > span:first-child {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 3px;
        left: 0;
        transform: translateX(0%);
        background-color: #2ba9cd;
      }
      .active-link {
        color: #2ba9cd !important;
      }
      .active-link > span:first-child {
        display: none;
      }
      .dropdown-box {
        width: 5rem;
        height: 5rem;
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        display: none;
        background-color: khaki;
      }
      .user-dropdown-link:hover + .dropdown-box {
        display: block;
      }
      .product-image{
          height: 10rem;
          object-fit: contain;
          object-position: center;
      }
      #hero-video{
          position: absolute;
          object-fit: cover;
          object-position: center;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1;
      }
      #hero-video-filter{
          background-color: #0002;
          z-index: 2;
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
      }
      .action-icon {
        transition: 0.5s ease;
      }
      .action-icon:hover {
        transform: scale(1.2);
        cursor: pointer;
      }
      .action-btn{
        text-decoration: none;
        outline: 0;
        border: 0;
        background: none;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <!-- nav bar -->
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
              <a class="nav-link nav-link-me active-link" aria-current="page" href="{{url("/")}}"
                >Home<span></span
              ></a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link nav-link-me" href="{{url("/favourites")}}"
                  >Favourites<span></span
                ></a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-link-me position-relative" href="{{url("/cart")}}"
                  >Cart<span></span
                  ><span class="badge rounded-pill bg-primary"> 99+ </span></a
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
        </div>
      </div>
    </nav>

    <!-- hero section -->
    <div class="container-fluid" id="hero">
        <video id="hero-video" playsinline autoplay muted loop>
            <source src="{{asset("/image/static/hero-video.mp4")}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div id="hero-video-filter"></div>
      <div
        class="d-flex container justify-content-center align-items-start flex-column w-100 h-100"
      >
        <div class="row w-100" style="z-index: 3">
            {{-- space --}}
            {{-- <div class="col-12 col-md-6"></div> --}}
             <!-- for hero content -->
            <div class="col-12 col-md-6 offset-md-3">
                <div class="mb-5">
                    <!-- title -->
                    <h3
                        class="text-light mb-3 text-center"
                        style="font-size: max(3vw, 25px)"
                    >
                        Browse & Get
                        everything online
                    </h3>

                    <!-- search bar -->
                    <form
                        action="{{url("/products"."#product-section")}}"
                        class="w-100 flex-column flex-sm-row mb-2 d-none d-sm-flex"
                        method="get"
                    >
                        <input
                        type="text"
                        name="search"
                        class="form-control me-sm-1 mb-2 mb-sm-0 px-3 py-2"
                        placeholder="Search product by name"
                        />
                        <div>
                        <button type="submit" class="btn btn-info m-0 p-sm-3 p-2 p-md-3">
                            Search
                        </button>
                        </div>
                    </form>

                <!-- suggested text -->
                    <p class="text-white-50 text-center">
                        The best online shop ever with latest fashion products available for
                        <a class="text-info" href="{{url("products/ageGroup/man#product-section")}}" style="text-decoration: none"
                        >men</a
                        >,
                        <a class="text-info" href="{{url("products/ageGroup/woman#product-section")}}" style="text-decoration: none"
                        >women</a
                        >
                        and
                        <a class="text-info" href="{{url("products/ageGroup/kid#product-section")}}" style="text-decoration: none"
                        >kids</a
                        >
                    </p>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- hero section -->

    <!-- product section -->
    @yield("content")
    <!-- product section -->

    <!-- feedback section -->
    <div class="container-fluid m-0 py-5" style="background-color: ghostwhite">
      <h3 class="fs-1 fw-bold mb-5 text-center my-5">What our clients said</h3>

      <div
        id="feedback-carousel"
        class="carousel slide carousel-dark my-5"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-5">
                  <img src="{{asset("/image/static/client1.jpeg")}}" alt="" class="img-fluid" />
                </div>
                <div class="col-1"></div>
                <div class="col-12 col-md-6">
                  <i class="fas fa-quote-left fa-3x"></i>
                  <div class="mb-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Quo blanditiis exercitationem ipsam deserunt illo excepturi
                    modi, vitae atque sequi ullam aspernatur cupiditate quis
                    culpa minima rem corporis similique recusandae asperiores
                    maxime! Ex eius totam reiciendis velit nihil? Error sequi
                    quas possimus labore voluptates, quasi, molestiae, qui odio
                    aut culpa exercitationem.
                  </div>
                  <div>
                    <div class="fw-bold fs-5">Michael Torvalds</div>
                    <div class="fw-light fs-7">Web developer</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-5">
                  <img src="{{asset("/image/static/client2.jpeg")}}" alt="" class="img-fluid" />
                </div>
                <div class="col-1"></div>
                <div class="col-12 col-md-6">
                  <i class="fas fa-quote-left fa-3x"></i>
                  <div class="mb-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Quo blanditiis exercitationem ipsam deserunt illo excepturi
                    modi, vitae atque sequi ullam aspernatur cupiditate quis
                    culpa minima rem corporis similique recusandae asperiores
                    maxime! Ex eius totam reiciendis velit nihil? Error sequi
                    quas possimus labore voluptates, quasi, molestiae, qui odio
                    aut culpa exercitationem.
                  </div>
                  <div>
                    <div class="fw-bold fs-5">Roberts Paterson</div>
                    <div class="fw-light fs-7">Freelance web designer</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-5">
                  <img src="{{asset("/image/static/client3.jpeg")}}" alt="" class="img-fluid" />
                </div>
                <div class="col-1"></div>
                <div class="col-12 col-md-6">
                  <i class="fas fa-quote-left fa-3x"></i>
                  <div class="mb-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Quo blanditiis exercitationem ipsam deserunt illo excepturi
                    modi, vitae atque sequi ullam aspernatur cupiditate quis
                    culpa minima rem corporis similique recusandae asperiores
                    maxime! Ex eius totam reiciendis velit nihil? Error sequi
                    quas possimus labore voluptates, quasi, molestiae, qui odio
                    aut culpa exercitationem.
                  </div>
                  <div>
                    <div class="fw-bold fs-5">Lisa Elizabeth</div>
                    <div class="fw-light fs-7">Professional photographer</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- feedback section -->

    <!-- footer section -->
    <div
      class="p-4 d-flex justify-content-center align-items-center bg-black text-white"
    >
      Created with <i class="fas fa-heart text-danger mx-1"></i> by
      <a
        href="https://www.facebook.com/thethan13/"
        class="text-info ms-1 creator-link"
        ><span>Thethan@2022</span></a
      >
    </div>
    <!-- footer section -->

    <!-- <div class="vh-100 bg-info"></div> -->
    <!-- script files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"
      integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script>
      $(() => {
        const navbar = document.getElementById("navbar");

        $("#navbar-toggler").toggle(
          () => {
            $("#navbar").removeClass("bg-transparent");
            $("#navbar").addClass("bg-white");
            $("#navbar").removeClass("shadow-0");
          },
          () => {
            $("#navbar").addClass("bg-transparent");
            $("#navbar").removeClass("bg-white");
            $("#navbar").addClass("shadow-0");
          }
        );

        window.addEventListener("scroll", () => {
          const offsetY = window.pageYOffset;
          $("#hero").css("background-position-y", `${offsetY * 0.4}px`);
          if (offsetY > 100) {
            $("#navbar").addClass("bg-white").removeClass("shadow-0")
          } else {
            $("#navbar").removeClass("bg-white").addClass("shadow-0")
          }
        });
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>
</html>
