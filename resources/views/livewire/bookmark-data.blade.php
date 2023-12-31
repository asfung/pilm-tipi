@php
$allBookmarks = getAllBookmark();
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

                    <time datetime="PT122M">
                        <?php
                        echo $inject_byId['runtime'];
                        ?>
                        min
                    </time>
                </div>

                <div class="rating">
                    <ion-icon name="star"></ion-icon>
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
                    <a href="{{ route('tv-details', ['id' => $tv['id']]) }}">
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

                    <!-- TODO -->
                    <!-- on popular endpoint wasnt has a runtime / duration property -->
                    <!-- just one way to get is just inject by id -->

                    <time datetime="PT122M">
                        <?php
                        foreach ($inject_tv_byId['episode_run_time'] as $time) {
                            echo $time . ",";
                        }
                        ?>
                        min
                    </time>
                </div>

                <div class="rating">
                    <ion-icon name="star"></ion-icon>

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
    @if(!$foundBookmarks)
    <li>
        <div class="flex items-center justify-center h-full pb-48" style="width: 1250px;">
            <div class="text-yellow-500 text-3xl mt-36">
                @php
                echo 'gk ada sirr :('
                @endphp
            </div>
        </div>
    </li>
    @endif
</ul>

