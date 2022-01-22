<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Savannah</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script> -->
    <link
      rel="stylesheet"
      href="{{asset("css/paper-dashboard.min.css")}}"
    />
    <!-- <link rel="stylesheet" href="./argon.min.css" /> -->
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&family=Lobster&family=Pacifico&family=Titillium+Web&display=swap");
      #hero {
        background-image: url("./image/static/heroImg3.jpg");
        background-position: top;
        background-size: cover;
        height: max(48vw, 30rem);
        backdrop-filter: blur(2px);
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
    </style>
  </head>
  <body>
    <!-- nav bar -->
    <nav
      class="navbar navbar-light text-black navbar-expand-lg bg-transparent w-100"
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
            @endauth
            @guest
            @yield("auth-links")
            @endguest

          </ul>
        </div>
      </div>
    </nav>

    <!-- hero section -->
    <div class="container-fluid" id="hero">
      <div
        class="d-flex container justify-content-center align-items-start flex-column w-100 h-100"
      >
        <div class="row w-100">
          <!-- for hero content -->
          @yield("content")
          <div class="col-12 col-md-6"></div>
        </div>
      </div>
    </div>
    <!-- hero section -->

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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

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
          },
          () => {
            $("#navbar").addClass("bg-transparent");
            $("#navbar").removeClass("bg-white");
          }
        );

        window.addEventListener("scroll", () => {
          const offsetY = window.pageYOffset;
          $("#hero").css("background-position-y", `${offsetY * 0.4}px`);
          if (offsetY > 100) {
            $("#navbar").addClass("bg-white").removeClass("shadow-0");
          } else {
            $("#navbar").removeClass("bg-white").addClass("shadow-0")
          }
        });
      });
    </script>
  </body>
</html>
