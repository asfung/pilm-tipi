<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class PopularMovie extends Component
{
    public function render()
    {
        $client = new \GuzzleHttp\Client();
        $http_id_value = Http::class;

        $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/popular?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
            'headers' => [
              'Authorization' => config('servies.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

        $data_film = json_decode($response->getBody(), true);

        // FIXED but not in here
        // $get_data_value = Http::asJson()->get(config('services.tmdb.endpoint') . 'movie/' . $data_film['results'][0]['id'] . '?api_key=' . config('services.tmdb.api'));

          // tv shows
        // $client = new \GuzzleHttp\Client();

        $responseTv = $client->request('GET', config('services.tmdb.endpoint') . 'trending/tv/week?include_adult=false&include_null_first_air_dates=false&language=en-US&page=1&sort_by=popularity.desc' . '&api_key=' . config('services.tmdb.api'), [
              'headers' => [
              'Authorization' => config('servies.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

    
        $tvShows = json_decode($responseTv->getBody(), true);
        return view('livewire.popular-movie', compact('data_film', 'tvShows'));
    }

    public function placeholder()
    {
        $output = '<ul class="movies-list">';

    for ($i = 0; $i < 8; $i++) {
        $output .= <<<HTML
        <li>
            <div class="movie-card">

                <a href="">
                    <figure class="card-banner">
                        <img src="/assets/images/no-image.jpg" alt="Sonic the Hedgehog 2 movie poster">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <div class="flex animate-pulse flex-row items-center h-full justify-center space-x-5">
                        <div class="flex flex-col space-y-3">
                            <div class="bg-gray-300 h-6 rounded-md " style="width: 170px; height: 20px;"></div>
                            <div class="bg-gray-300 h-6 rounded-md " style="width: 150px; height: 20px;"></div>
                        </div>
                    </div>

                    <time datetime="2022">
                        <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>
                    </time>
                </div>

                <div class="card-meta">
                    <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>

                    <div class="duration">
                        <time datetime="PT122M">
                            <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>
                        </time>
                    </div>

                    <div class="rating">
                        <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>
                    </div>
                </div>

            </div>
        </li>
    HTML;
    }

    $output .= '</ul>';

    return $output;
    }
}

// <!-- <div class="w-60 h-24 border-2 rounded-md mx-auto mt-20"> -->
//             <div class="flex animate-pulse flex-row items-center h-full justify-center space-x-5">
//                 <!-- <div class="w-12 bg-gray-300 h-12 rounded-full "></div> -->
//                     <div class="flex flex-col space-y-3">
//                     <div class="w-36 bg-gray-300 h-6 rounded-md "></div>
//                     <div class="w-24 bg-gray-300 h-6 rounded-md "></div>
//                 </div>
//             </div>
//             <!-- </div> -->