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
  <link rel="stylesheet" href="./assets/css/style.css">

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
            <a href="#top" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="#top-rated-movie" class="navbar-link">Movie</a>
          </li>

          <!-- just authenticated user can access -->
          @if(Auth::check())
          <li>
            <a href="#tv-series" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="/user/bookmarks" class="navbar-link">Bookmarks</a>
          </li>
          @else
          <li>
            <a href="/login" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="/login" class="navbar-link">Bookmarks</a>
          </li>
          @endif

          <!-- <li>
            <a href="#" class="navbar-link">Web Series</a>
          </li> -->

          <!-- <li>
            <a href="#" class="navbar-link">Pricing</a>
          </li> -->

        </ul>

        <ul class="navbar-social-list">

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <!-- TODO -->
      <!-- for hero section background image is using filament -->

      <section class="hero">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">Pilem, Tipi</p>

            <h1 class="h1 hero-title">
              Kumpulan <strong>Pilem</strong>, tipi show.
            </h1>

            <div class="meta-wrapper">

              <!-- <div class="badge-wrapper">
                <div class="badge badge-fill">PG 18</div>

                <div class="badge badge-outline">HD</div>
              </div> -->

              <!-- <div class="ganre-wrapper">
                <a href="#">Romance,</a>

                <a href="#">Drama</a>
              </div> -->

              <!-- <div class="date-time">

                <div>
                  <ion-icon name="calendar-outline"></ion-icon>

                  <time datetime="2022">2022</time>
                </div>

                <div>
                  <ion-icon name="time-outline"></ion-icon>

                  <time datetime="PT128M">128 min</time>
                </div>

              </div> -->

            </div>

            <!-- <button class="btn btn-primary"> -->
              <!-- <ion-icon name="play"></ion-icon> -->

              <!-- <span>Watch now</span> -->
            <!-- </button> -->

          </div>

        </div>
      </section>





      <!-- 
        - #UPCOMING
      -->

      <!-- <section class="upcoming">
        <div class="container">

          <div class="flex-wrapper">

            <div class="title-wrapper">
              <p class="section-subtitle">online streaming</p>

              <h2 class="h2 section-title">upcoming movies</h2>
            </div>

            <ul class="filter-list">

              <li>
                <button class="filter-btn">movies</button>
              </li>

              <li>
                <button class="filter-btn">tv shows</button>
              </li>

              <li>
                <button class="filter-btn">anime</button>
              </li>

            </ul>

          </div>

          <ul class="movies-list  has-scrollbar">

            <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/upcoming-1.png" alt="the northman movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">the northman</h3>
                  </a>

                  <time datetime="2022">2022</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">hd</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="pt137m">137 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>8.5</data>
                  </div>
                </div>

              </div>
            </li>

            <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/upcoming-2.png"
                      alt="doctor strange in the multiverse of madness movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">doctor strange in the multiverse of madness</h3>
                  </a>

                  <time datetime="2022">2022</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">4k</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="pt126m">126 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>nr</data>
                  </div>
                </div>

              </div>
            </li>

            <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/upcoming-3.png" alt="memory movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">memory</h3>
                  </a>

                  <time datetime="2022">2022</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">2k</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="">n/a</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>nr</data>
                  </div>
                </div>

              </div>
            </li>

            <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/upcoming-4.png"
                      alt="the unbearable weight of massive talent movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">the unbearable weight of massive talent</h3>
                  </a>

                  <time datetime="2022">2022</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">hd</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="pt107m">107 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>nr</data>
                  </div>
                </div>

              </div>
            </li>

          </ul>

        </div>
      </section> -->





      <!-- 
        - #SERVICE
      -->

      <!-- <section class="service">
        <div class="container">

          <div class="service-banner">
            <figure>
              <img src="./assets/images/service-banner.jpg" alt="HD 4k resolution! only $3.99">
            </figure>

            <a href="./assets/images/service-banner.jpg" download class="service-btn">
              <span>Download</span>

              <ion-icon name="download-outline"></ion-icon>
            </a>
          </div>

          <div class="service-content">

            <p class="service-subtitle">Our Services</p>

            <h2 class="h2 service-title">Download Your Shows Watch Offline.</h2>

            <p class="service-text">
              Lorem ipsum dolor sit amet, consecetur adipiscing elseddo eiusmod tempor.There are many variations of
              passages of lorem
              Ipsum available, but the majority have suffered alteration in some injected humour.
            </p>

            <ul class="service-list">

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <ion-icon name="tv"></ion-icon>
                  </div>

                  <div class="card-content">
                    <h3 class="h3 card-title">Enjoy on Your TV.</h3>

                    <p class="card-text">
                      Lorem ipsum dolor sit amet, consecetur adipiscing elit, sed do eiusmod tempor.
                    </p>
                  </div>

                </div>
              </li>

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <ion-icon name="videocam"></ion-icon>
                  </div>

                  <div class="card-content">
                    <h3 class="h3 card-title">Watch Everywhere.</h3>

                    <p class="card-text">
                      Lorem ipsum dolor sit amet, consecetur adipiscing elit, sed do eiusmod tempor.
                    </p>
                  </div>

                </div>
              </li>

            </ul>

          </div>

        </div>
      </section> -->





      <!-- 
        - #TOP RATED
      -->

      <section class="top-rated" id="top-rated-movie">
        <div class="container">

          <p class="section-subtitle">Movie</p>

          <h2 class="h2 section-title">Popular Movies</h2>


          <ul class="movies-list">

            @foreach($data_film['results'] as $movie)

            <li>
              <div class="movie-card">

                <a href="{{ route('movie-details', ['id' => $movie['id']]) }}">
                  <figure class="card-banner">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}" alt="poster">
                  </figure>
                </a>

                <!-- troubleshooting -->
                <!-- <p style="color: white;">
                <?php 
                // dump($get_data_value = Illuminate\Support\Facades\Http::asJson()->get(config('services.tmdb.endpoint') . 'movie/' . $movie['id'] . '?api_key=' . config('services.tmdb.api'))->json());
                // echo $get_data_value['title'];
                ?>
                </p> -->
                
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
            </li>
            @endforeach

          </ul>

        </div>
      </section>





<!--       
        - #TV SERIES
      -->

      @if(Auth::check())

      <section class="tv-series" id="tv-series">
        <div class="container">

          <p class="section-subtitle">Best TV Series</p>

          <h2 class="h2 section-title">Trending TV Series</h2>

          <ul class="movies-list">


            @foreach($tvShows['results'] as $tvShow)

            <li>
              <div class="movie-card">

                <a href="{{ route('tv-details', ['id' => $tvShow['id']]) }}">
                  <figure class="card-banner">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path'] }}" alt="tvshow">
                  </figure>
                </a>

                <div class="title-wrapper">
                  @if(Auth::check())
                    <livewire:bookmarks :id_item="$tvShow['id']" :item_type="'tv'">
                  @endif
                  <a href="{{ route('tv-details', ['id' => $tvShow['id']]) }}">
                    <h3 class="card-title">{{$tvShow['name']}}</h3>
                  </a>

                  <time datetime="">{{ date('Y',strtotime($tvShow['first_air_date'])) }}</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">
                    <?php
                      $inject_tv_byId = getTvById($tvShow['id']);
                      echo $inject_tv_byId['status'];
                      ?>
                  </div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="PT47M">
                    <?php
                      foreach($inject_tv_byId['episode_run_time'] as $time) {
                        echo $time . ",";
                      }
                    ?>  
                    min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>{{ $tvShow['vote_average'] }}</data>
                  </div>
                </div>

              </div>
            </li>

            @endforeach

            <!-- <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/series-2.png" alt="Halo movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">Halo</h3>
                  </a>

                  <time datetime="2022">2022</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">2K</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="PT59M">59 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>8.8</data>
                  </div>
                </div>

              </div>
            </li>

            <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/series-3.png" alt="Vikings: Valhalla movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">Vikings: Valhalla</h3>
                  </a>

                  <time datetime="2022">2022</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">2K</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="PT51M">51 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>8.3</data>
                  </div>
                </div>

              </div>
            </li>

            <li>
              <div class="movie-card">

                <a href="./movie-details.html">
                  <figure class="card-banner">
                    <img src="./assets/images/series-4.png" alt="Money Heist movie poster">
                  </figure>
                </a>

                <div class="title-wrapper">
                  <a href="./movie-details.html">
                    <h3 class="card-title">Money Heist</h3>
                  </a>

                  <time datetime="2017">2017</time>
                </div>

                <div class="card-meta">
                  <div class="badge badge-outline">4K</div>

                  <div class="duration">
                    <ion-icon name="time-outline"></ion-icon>

                    <time datetime="PT70M">70 min</time>
                  </div>

                  <div class="rating">
                    <ion-icon name="star"></ion-icon>

                    <data>8.3</data>
                  </div>
                </div>

              </div>
            </li> -->

          </ul>

        </div>
      </section>

      @endif




      <!-- 
        - #CTA
      -->

      <!-- <section class="cta">
        <div class="container">

          <div class="title-wrapper">
            <h2 class="cta-title">Trial start first 30 days.</h2>

            <p class="cta-text">
              Enter your email to create or restart your membership.
            </p>
          </div>

          <form action="" class="cta-form">
            <input type="email" name="email" required placeholder="Enter your email" class="email-field">

            <button type="submit" class="cta-form-btn">Get started</button>
          </form>

        </div>
      </section> -->

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <!-- <div class="footer-top"> -->
      <!-- <div class="container"> -->

        <!-- <div class="footer-brand-wrapper">

          <a href="./index.html" class="logo">
            <img src="./assets/images/logo.svg" alt="Filmlane logo">
          </a>

          <ul class="footer-list">

            <li>
              <a href="./index.html" class="footer-link">Home</a>
            </li>

            <li>
              <a href="#" class="footer-link">Movie</a>
            </li>

            <li>
              <a href="#" class="footer-link">TV Show</a>
            </li>

            <li>
              <a href="#" class="footer-link">Web Series</a>
            </li>

            <li>
              <a href="#" class="footer-link">Pricing</a>
            </li>

          </ul>

        </div> -->

        <!-- <div class="divider"></div> -->

        <!-- <div class="quicklink-wrapper">

          <ul class="quicklink-list">

            <li>
              <a href="#" class="quicklink-link">Faq</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Help center</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Terms of use</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Privacy</a>
            </li>

          </ul>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div> -->

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2023 <a href="#">Paung</a>. All Rights Reserved
        </p>

        <img src="./assets/images/footer-bottom-img.png" alt="Online banking companies logo" class="footer-bottom-img">

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