<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $movieDetails['title'] }}</title>

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

<style>
  .movie-detail {
    background: url("https://image.tmdb.org/t/p/original{{ $movieDetails['poster_path'] }}") no-repeat;
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
        <p class="hero-subtitle">Pilem Lah</p>
      </a>

      <div class="header-actions">

        <!-- <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button> -->
        <livewire:search-dropdown>

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
            <img src="./assets/images/logo.svg" alt="Filmlane logo"> <!-- TODO:change the logo  -->
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
            <a href="/#top-rated-movie" class="navbar-link">Movie</a>
          </li>

          <li>
            <a href="/#tv-series" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="/user/bookmarks" class="navbar-link">Bookmarks</a>
          </li>
          <!-- 
          <li>
            <a href="#" class="navbar-link">Pricing</a>
          </li> -->

        </ul>

      </nav>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #MOVIE DETAIL
      -->

      <section class="movie-detail">
        <div class="container">

          <figure class="movie-detail-banner">
            <a href="{{$movieDetails['homepage']}}" target="_blank">
              <img src="{{ 'https://image.tmdb.org/t/p/original' . $movieDetails['poster_path'] }}" alt="poster">
            </a>
          </figure>

          <div class="movie-detail-content">

            @if(Auth::check())
            <livewire:bookmarks :id_item="$movieDetails['id']" :item_type="'movie'">
              @endif
              <p class="detail-subtitle">{{ $movieDetails['tagline'] }}</p>

              <div class="movie-trailer">
                @foreach($movieTrailers['results'] as $trailer)
                @if($trailer['type'] === "Trailer" && $trailer['name'] === "Official Trailer")
                <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/{{ $trailer['key'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
                @endforeach
              </div>


              <h1 class="h1 detail-title">
                {{ $movieDetails['title'] }}
              </h1>

              <div class="meta-wrapper">

                <!-- <div class="badge-wrapper">
                <div class="badge badge-fill">PG 13</div>

                <div class="badge badge-outline">HD</div>
              </div> -->

                <div class="ganre-wrapper">

                  @if(count($movieDetails['genres']) > 0)
                  @php
                  $num_of_items = count($movieDetails['genres']);
                  $num_count = 0;
                  @endphp
                  @foreach ($movieDetails['genres'] as $singleGenre)
                  <a class="text-sm">
                    {{ $singleGenre['name'] }}
                  </a>
                  @php
                  $num_count = $num_count + 1;
                  if ($num_count < $num_of_items) { echo '<a class="mx-2 flex items-center">•</a>' ; } @endphp @endforeach @endif </div>

                    <div class="date-time">

                      <div>
                        <ion-icon name="calendar-outline"></ion-icon>

                        <!-- <time>{{ date('Y',strtotime($movieDetails['release_date'])) }}</time> -->
                        <time>{{ $movieDetails['release_date'] }}</time>
                      </div>

                      <div>
                        <ion-icon name="time-outline"></ion-icon>

                        <time datetime="PT115M">{{ $movieDetails['runtime'] }} min</time>
                      </div>

                    </div>

                </div>

                <p class="storyline">
                  {{ $movieDetails['overview'] }}
                </p>
                <!-- <p>status: {{ $movieDetails['status'] }}</p> -->

              </div>


          </div>

          <div class="container" style="color: yellow; padding-top:4rem;">
            <h1 style="font-size:40px; font-weight:bold;">Cast</h1>
          </div>


          <!-- TODO make it the cast beauty layout lel! -->
          <!-- <div class="cast-container">
          <div class="cast-content text-white">
            @php
              $i = 0;
            @endphp
            @foreach($movieDetails['credits']['cast'] as $cast)
            <ul class="cast-list">
              <li>
                <div class="cast-card">
                  <img src="https://image.tmdb.org/t/p/original{{$cast['profile_path']}}" alt="poster" width="200" height="280">
                </div>
              </li>
            </ul>
            @php
              $i++;
              if($i === 7){
                break;
              }
            @endphp
            @endforeach
          </div>
        </div> -->

          <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] border border-solid border-x-2 border-yellow-400 m-5 backdrop-blur-md bg-slate-700/25">
            <!-- card body  -->
            <div class="flex-auto block py-8 px-9 text-white">
              <div>
                <!-- <div class="mb-9">
                  <h1 class="mb-2 text-[1.75rem] font-semibold text-yellow-400">Casts</h1>
                </div> -->
                <div class="flex flex-wrap w-auto">
                  <!-- card item -->
                  @php
                  $i = 0;
                  @endphp
                  @foreach($movieDetails['credits']['cast'] as $cast)
                  <div class="flex flex-col mr-5 text-center mb-11 lg:mr-16">
                    <div class="inline-block mb-4 relative shrink-0 rounded-[.95rem]">
                      <img class="inline-block shrink-0 rounded-[.95rem] w-[200px] h-[280px]" src="https://image.tmdb.org/t/p/original{{$cast['profile_path']}}" alt="Actor">
                    </div>
                    <div class="text-center">
                      <p href="javascript:void(0)" class="text-yellow-400 font-semibold hover:text-primary text-[1.25rem] transition-colors duration-200 ease-in-out">{{$cast['name']}}</p>
                      <span>{{ $cast['character'] }}</span>
                    </div>
                  </div>
                  @php
                  $i++;
                  if($i === 20){
                  break;
                  }
                  @endphp
                  @endforeach

                </div>
              </div>
            </div>
          </div>

      </section>





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
  <script src="/assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>