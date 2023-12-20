<?php
$allBookmarks = getAllBookmark();

?>


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
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

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

          @php
            $foundBookmarks = false; 
          @endphp
      <ul class="movies-list">
        @foreach($allBookmarks as $getId) 
          @if($getId->name_user === Auth::user()->name)
          @foreach(getMovieByArray([$getId->item_id]) as $movie)
            <li>
              <div class="movie-card">

                <a href="{{ route('movie-details', ['id' => $movie['id']]) }}">
                  <figure class="card-banner">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}" alt="poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  @if(Auth::check())
                    <livewire:bookmarks :id_item="$movie['id']" :item_type="'movie'">
                  @endif
                  <!-- <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20"> <path d="M13 20a1 1 0 0 1-.64-.231L7 15.3l-5.36 4.469A1 1 0 0 1 0 19V2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v17a1 1 0 0 1-1 1Z"/> </svg> -->
                <a href="{{ route('movie-details', ['id' => $movie['id']]) }}">
                    <h3 class="card-title">{{ $movie['title'] }}</h3>
                  </a>

                  <time>{{ date('Y',strtotime($movie['release_date'])) }}</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">
                    <?php
                      $inject_byId = getMovieById($movie['id']);
                      echo $inject_byId['status'];
                      ?>
                  </div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <!-- <time datetime="PT122M">{{ 'https://api.themoviedb.org/3/movie/' . $movie['id'] }} min</time> -->
                    <!-- TODO -->
                    <!-- on popular endpoint wasnt has a runtime / duration property -->
                    <!-- just one way to get is just inject by id -->
                    
                    <time datetime="PT122M">
                    <?php
                      echo $inject_byId['runtime'];
                      ?>
                    min</time>

                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <!-- <data>{{ $movie['vote_average'] }}</data> -->
                    <data>{{ number_format($movie['vote_average'], 2) }}</data>

                    
                  </div>
                </div>

              </div>
              @php
                $foundBookmarks = true;
              @endphp
            </li>
          @endforeach

          @foreach(getTvByArray([$getId->item_id]) as $tv)
            <li>
              <div class="movie-card">

                <a href="{{ route('tv-details', ['id' => $tv['id']]) }}">
                  <figure class="card-banner">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $tv['poster_path'] }}" alt="poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  @if(Auth::check())
                    <livewire:bookmarks :id_item="$tv['id']" :item_type="'tv'">
                  @endif
                  <!-- <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20"> <path d="M13 20a1 1 0 0 1-.64-.231L7 15.3l-5.36 4.469A1 1 0 0 1 0 19V2a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v17a1 1 0 0 1-1 1Z"/> </svg> -->
                <a href="{{ route('movie-details', ['id' => $movie['id']]) }}">
                    <h3 class="card-title">{{ $tv['name'] }}</h3>
                  </a>

                  <time>{{ date('Y',strtotime($tv['first_air_date'])) }}</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">
                    <?php
                      $inject_tv_byId = getTvById($tv['id']);
                      echo $inject_tv_byId['status'];
                      ?>
                  </div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <!-- <time datetime="PT122M">{{ 'https://api.themoviedb.org/3/movie/' . $movie['id'] }} min</time> -->
                    <!-- TODO -->
                    <!-- on popular endpoint wasnt has a runtime / duration property -->
                    <!-- just one way to get is just inject by id -->
                    
                    <time datetime="PT122M">
                    <?php
                      foreach($inject_tv_byId['episode_run_time'] as $time) {
                        echo $time . ",";
                      }
                      ?>
                    min</time>

                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <!-- <data>{{ $movie['vote_average'] }}</data> -->
                    <data>{{ number_format($tv['vote_average'], 2) }}</data>

                    
                  </div>
                </div>

              </div>
              @php
                $foundBookmarks = true;
              @endphp
            </li>
          @endforeach
          @endif
        @endforeach
      </ul>

      @if(!$foundBookmarks)
        <li>
          <div class="flex items-center justify-center h-full pb-32">
            <div class="text-yellow-500 text-3xl mt-24">
              @php
              echo 'sedih bat gk ada :('
              @endphp
            </div>
          </div>
        </li>
        @endif


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
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>