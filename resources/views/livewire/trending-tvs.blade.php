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
                        foreach ($inject_tv_byId['episode_run_time'] as $time) {
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
</ul>