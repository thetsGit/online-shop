<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Savannah</title>
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
      .nav-link {
        position: relative;
        transition: 0.5s ease;
        z-index: 1;
      }
      .nav-link:not(.nav-link.order-section):hover {
        color: #2ba9cd !important;
      }
      .nav-link::before {
        content: "";
        inset: 0;
        background-color: transparent;
        position: absolute;
        width: 0;
        height: 0;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: 0.5s ease;
        border-radius: 10rem;
        z-index: -1;
      }
      .nav-link:not(.nav-link.order-section):hover::before {
        width: 100%;
        height: 100%;
        background-color: #fff;
      }
      .nav-link.active-link::before {
        width: 100%;
        height: 100%;
        background-color: #fff;
      }
      .nav-link.active-link {
          color: #2ba9cd!important;
      }
      .active-link > span:first-child {
        display: none;
      }
      .order-product-image {
        width: 3rem;
        height: 4rem;
        object-fit: cover;
        object-position: center;
      }
      .cart-product-image {
        width: 7rem;
        object-fit: cover;
      }
      .nav-tabs .nav-link {
        color: #2ba9cd;
      }
      .nav-tabs .nav-link.active {
        color: #000;
      }
      .cmt-profile {
        width: 2rem;
        height: 2rem;
        object-fit: cover;
        object-position: center;
      }
      .cmt-profile-me {
        width: 2.5rem;
        height: 2.5rem;
        object-fit: cover;
        object-position: center;
      }
      /* .action-icon {
        transition: 0.5s ease;
      }
      .action-icon:hover {
        transform: scale(1.2);
        cursor: pointer;
      } */
      .action-btn{
        text-decoration: none;
        outline: 0;
        border: 0;
        background: none;
      }
      .delete-cmt-btn:hover{
        background-color: #EF8157!important;
        cursor: pointer!important;
        color: white!important;
      }
      .comment-wrap>.delete-btn-wrap{
        display: none;
      }
      .comment-wrap:hover>.delete-btn-wrap{
        display:block;
      }
      #image-upload-btn{
        width: 100%;
        height: 100%;
        background-color: #0008;
        position: absolute;
        inset: 0;
        display: none;
      }
      #upload-icon{
        opacity: .5;
        cursor: pointer;
      }
      #upload-icon:hover{
        opacity: 1;
      }
      #image-container:hover>#image-upload-btn{
        display: block;
      }
      .likeBtn,.favouriteBtn{
        display: inline-block;
        transition: 0.5s ease;
      }
      .likeBtn:hover,.favouriteBtn:hover{
          transform:scale(1.2);
      }
      .favouriteBtn>*{
          pointer-events: none;
      }
      .likeBtn>*{
          pointer-events: none;
      }
    </style>
  </head>
  <body>
    <!-- nav bar -->
    <nav
      class="navbar text-white navbar-expand-lg bg-primary w-100 shadow-3"
      style="position: fixed; display: block; top: 0; z-index: 10000"
      id="navbar"
    >
      <div class="container-fluid">
        <a class="navbar-brand text-white" id="navbar-brand" href="#"
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
         @yield('nav-items')
        </div>
      </div>
    </nav>

    @yield('content')

    <!-- footer section -->
    <div
      class="p-4 d-flex justify-content-center align-items-center bg-white text-black"
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
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"
      integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"
      integrity="sha512-fHXRw0CXruAoINU11+hgqYvY/PcsOWzmj0QmcSOtjlJcqITbPyypc8cYpidjPurWpCnlB8VKfRwx6PIpASCUkQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js" integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('extra-script')
 @include('layout.triggerNoty')
  </body>
</html>
