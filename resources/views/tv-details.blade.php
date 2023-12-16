<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $tvDetails['name'] }}</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/card-image/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>

<style>
  .movie-detail {
    /* background: url("https://image.tmdb.org/t/p/w500{{ $tvDetails['poster_path'] }}") no-repeat; */
    background-size: cover;
    background-position: center;
    padding-top: 160px;
    padding-bottom: var(--section-padding);
  }

  .movie-detail::before {
    content: '';
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: inherit;
    background-size: cover;
    backdrop-filter: blur(10px);
    z-index: -1;
  }
</style>

<body id="#top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="/" class="logo">
        <p class="hero-subtitle">Pilem Lah | {{Auth::user()->name}}</p>
      </a>

      <div class="header-actions">

        <!-- <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button> -->
        <livewire:search-dropdown :width="72">

          <!-- <button class="btn btn-primary">Sign in</button> -->
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
            <a href="/" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Movie</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Bookmarks</a>
          </li>

          <!-- <li>
            <a href="#" class="navbar-link">Pricing</a>
          </li> -->

        </ul>
      </nav>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #tv DETAIL
      -->

      <section class="movie-detail">
        <div class="container">

          <figure class="movie-detail-banner">

            <img src="{{ 'https://image.tmdb.org/t/p/w500' . $tvDetails['poster_path'] }}" alt="poster">

            <button class="play-btn">
              <!-- <ion-icon name="play-circle-outline"></ion-icon> -->
            </button>

          </figure>

          <div class="movie-detail-content">
            <!-- tagline -->
            <p class="detail-subtitle">{{ $tvDetails['tagline'] }}</p>

            <h1 class="h1 detail-title">
              <!-- title -->
              {{ $tvDetails['name'] }}
            </h1>

            <div class="meta-wrapper">

              <!-- <div class="badge-wrapper">
                <div class="badge badge-fill">PG 13</div>

                <div class="badge badge-outline">HD</div>
              </div> -->

              <div class="ganre-wrapper">
                @if(count($tvDetails['genres']) > 0)
                @php
                $num_of_items = count($tvDetails['genres']);
                $num_count = 0;
                @endphp
                @foreach ($tvDetails['genres'] as $singleGenre)
                <a class="text-sm">
                  {{ $singleGenre['name'] }}
                </a>
                @php
                $num_count = $num_count + 1;
                if ($num_count < $num_of_items) { echo '<a class="mx-2 flex items-center">•</a>' ; } @endphp @endforeach @endif </div>

                  <div class="date-time">

                    <div>
                      <ion-icon name="calendar-outline"></ion-icon>

                      <!-- release date -->
                      <p>Release Date:</p><time>{{ date('Y',strtotime($tvDetails['first_air_date'])) }}</time>
                    </div>

                    <div>
                      <!-- <ion-icon name="time-outline"></ion-icon> -->
                      <svg width="17px" height="17px" viewBox="0 -2 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#fff70a" stroke="#fff70a">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <title>arrow-right</title>
                          <desc>Created with Sketch Beta.</desc>
                          <defs> </defs>
                          <g id="Page-1" stroke-width="1.1199999999999999" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                            <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-360.000000, -933.000000)" fill="#dbeb00">
                              <path d="M388,933 L368,933 C365.791,933 364,934.791 364,937 L364,941 L366,941 L366,937 C366,935.896 366.896,935 368,935 L388,935 C389.104,935 390,935.896 390,937 L390,957 C390,958.104 389.104,959 388,959 L368,959 C366.896,959 366,958.104 366,957 L366,953 L364,953 L364,957 C364,959.209 365.791,961 368,961 L388,961 C390.209,961 392,959.209 392,957 L392,937 C392,934.791 390.209,933 388,933 L388,933 Z M377.343,953.243 C376.953,953.633 376.953,954.267 377.343,954.657 C377.733,955.048 378.367,955.048 378.758,954.657 L385.657,947.758 C385.865,947.549 385.954,947.272 385.94,947 C385.954,946.728 385.865,946.451 385.657,946.243 L378.758,939.344 C378.367,938.953 377.733,938.953 377.343,939.344 C376.953,939.733 376.953,940.367 377.343,940.758 L382.586,946 L361,946 C360.447,946 360,946.448 360,947 C360,947.553 360.447,948 361,948 L382.586,948 L377.343,953.243 L377.343,953.243 Z" id="arrow-right" sketch:type="MSShapeGroup"> </path>
                            </g>
                          </g>
                        </g>
                      </svg>

                      <!-- minute -->
                      <time datetime="PT115M">{{ $tvDetails['number_of_seasons'] }} Seasons</time>
                    </div>

                  </div>

              </div>

              <p class="storyline">
                <!-- story line -->
                {{ $tvDetails['overview'] }}
              </p>
            </div>

          </div>

          <div class="container" style="color: yellow; padding-top:4rem;">
            <h1 style="font-size:40px;">Seasons</h1>
          </div>

          <div class="slider card-slider" data-slider>

            <div class="slider-container" id="slider-c" data-slider-container>

              @php
              $sortedSeasons = collect($tvDetails['seasons'])
              ->filter(function ($season) {
              return $season['air_date'] !== null;
              })
              ->sortByDesc('air_date')
              ->values()
              ->all();
              @endphp

              @foreach($sortedSeasons as $season)
              <div class="slider-item">
                <div class="card img-holder" style="--width: 500; --height: 750;">
                  <img src="{{ 'https://image.tmdb.org/t/p/w500' . $season['poster_path']}}" width="500" height="750" alt="" class="img-cover">
                </div>
                <div class="card-meta" style="display: flex;">
                  <p class="card-title" style="color: white; margin-right:120px;">{{ $season['name'] }}</p>
                  <p class="rating" style="color: yellow;">{{ $season['episode_count'] }} Eps</p>
                </div>
                <p class="storyline">{{$season['air_date']}}</p>
              </div>
              @endforeach

            </div>

            <button class="btn-icon slider-control prev" data-slider-prev>
              <ion-icon name="arrow-back-sharp"></ion-icon>
            </button>

            <button class="btn-icon slider-control next" data-slider-next>
              <ion-icon name="arrow-forward-sharp"></ion-icon>
            </button>

          </div>


      </section>

  </main>

  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">


        <div class="quicklink-wrapper">

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
    </div>

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
  <script src="/card-image/script.js"></script>

  <!-- 
    - ionicon
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- mousewheel slider animation  -->
  <script>
    const sliderContainer = document.getElementById('slider-c');

    sliderContainer.addEventListener('wheel', (event) => {
      event.preventDefault();

      const scrollDelta = event.deltaY || event.detail || event.wheelDelta;

      sliderContainer.scrollLeft += scrollDelta * scrollSensitivity;
      sliderContainer.style.transition = 'transform 0.5s ease';
    });
  </script>
</body>

</html>