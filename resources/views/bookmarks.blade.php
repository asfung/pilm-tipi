<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>pilem ato tipi lah bossss...</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="http://localhost:8998/favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="/assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="./index.html" class="logo">
        <!-- <img src="./assets/images/logo.svg" alt="Filmlane logo"> -->

        @if(Auth::check())
        <div>
        <!-- <p class="text-yellow-400 font-bold text-3xl">pilem atooo tipi | {{ Auth::user()->name }}</p> -->
        <p class="hero-subtitle">pilem atooo tipi | {{ Auth::user()->name }}</p>
        </div>
        @else
        <p class="hero-subtitle">pilem atooo tipi</p>
        @endif
      </a>

      <div class="header-actions">

        <!-- <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button> -->
        <livewire:search-dropdown>

        @if(Auth::check())
        <a href="/logout"><button class="btn btn-primary">Logout</button></a>
        @else
        <a href="/login"><button class="btn btn-primary">Login</button></a>
        @endif


      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="./index.html" class="logo">
            <img src="./assets/images/logo.svg" alt="Filmlane logo">
          </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li>
            <a href="/#top" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="/#top-rated-movie" class="navbar-link">Movie</a>
          </li>

          <!-- just authenticated user can access -->
          <li>
            <a href="/#tv-series" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="/user/bookmarks" class="navbar-link">Bookmarks</a>
          </li>

        </ul>

      </nav>

    </div>
  </header>


  <main>
    <article>
      <!-- 
        - #TOP RATED
      -->

      <section class="top-rated" id="top-rated-movie">
        <div class="container">

          <p class="section-subtitle">Bookmarks</p>

          <h2 class="h2 section-title border-b-4">Your All Bookmarks, {{ Auth::user()->name }}</h2>

         <livewire:bookmark-data lazy="on-load" /> 


        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2023 <a href="#">Paung</a>. All Rights Reserved
        </p>

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="http://localhosst:8998/assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>