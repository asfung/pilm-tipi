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