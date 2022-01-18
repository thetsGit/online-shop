<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+P+One&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset("/css/argon.min.css")}}">
    <title>Savannah Admin</title>
    <style>
      .list-group-item-action:hover {
        color: #f93154;
        cursor: pointer;
      }
      .pop-one {
        font-family: "Mochiy Pop P One", sans-serif;
      }
      .user-profile,.product-img {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        object-position: center;
        object-fit: cover;
      }
      .admin-profile{
          width: 17rem;
      }
      body{
          background-color: #FFF8F9;
          overflow-x: hidden;
          max-width: 100vw;

      }
      #wave{
          position: absolute;
          width: 200%;
          right: 50;
          bottom: -65%;
      }
    </style>
  </head>
  <body>
    <div class="row container-fluid m-0 p-0" style="z-index: 100!important;position: relative;">
      <aside class="col-md-3 ps-4 py-5 col-12">
        <div class="card px-md-3 py-md-4 p-1 m-0">
        <div class="px-md-3 p-1 text-center mb-3 d-none d-md-block" style="z-index: 1000">
          <i class="fas fa-cat text-danger fa-2x"></i>
          <span class="pop-one text-warning d-lg-inline d-none" id="logo-text">Savannah</span>
        </div>

        @yield('aside')
        </div>
      </aside>

      <div class="col-md-9 col-12 py-md-5 py-0">
        <!-- content -->
        @yield('content')
      </div>
    </div>
    <img src="{{asset('/svgs/wave.svg')}}" alt="wave svg" id="wave">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const logoText = document.getElementById('logo-text');
        logoText.innerHTML = logoText.innerHTML.split('').map(char => `<span style="display: inline-block">${char}</span>`).join('');
             anime({
            targets: '#main-content',
            translateY: [100,0],
            opacity: [0,1],
            duration: 500,
            easing: 'easeOutExpo'
        });
        anime({
            targets: '#wave',
            translateY: [200,0],
            translateX: [-1000,0],
            duration: 3000,
        });
        anime.timeline({
            loop: true,
            direction: 'alternate'
        }).add({
            targets: '#logo-text span',
            rotate: () => anime.random(-360,360),
            translateY: () => anime.random(-100,0),
            translateX: () => anime.random(100,0),
            delay: anime.stagger(50,{'start':5000}),
        });
        anime.timeline().add({
            targets: '.table-row',
            translateY: [-200,0],
            delay: anime.stagger(100,{'start':500}),
            opacity: [0,1]
        }).add({
            targets: '.page-item',
            translateX: [-100,0],
            opacity: [0,1],
            delay: anime.stagger(100)
        },-100)
    </script>
    @yield('text-count')
  </body>
</html>
