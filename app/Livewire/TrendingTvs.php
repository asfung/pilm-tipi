<?php

namespace App\Livewire;

use Livewire\Component;

class TrendingTvs extends Component
{

    public function render()
    {
        $client = new \GuzzleHttp\Client();
        $responseTv = $client->request('GET', config('services.tmdb.endpoint') . 'trending/tv/week?include_adult=false&include_null_first_air_dates=false&language=en-US&page=1&sort_by=popularity.desc' . '&api_key=' . config('services.tmdb.api'), [
              'headers' => [
              'Authorization' => config('servies.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

    
        $tvShows = json_decode($responseTv->getBody(), true);

        return view('livewire.trending-tvs', compact('tvShows'));
    }

    public function placeholder(){
           
        $output = '<ul class="movies-list">';

    for ($i = 0; $i < 8; $i++) {
        $output .= <<<HTML
        <!-- return <<<HTML -->
        <!-- <ul class="movies-list"> -->
        <li>
            <div class="movie-card">

                <a>
                    <figure class="card-banner">
                        <img src="/assets/images/no-image.jpg" alt="poster">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <div class="flex animate-pulse flex-row items-center h-full justify-center space-x-5">
                        <div class="flex flex-col space-y-3">
                            <div class="bg-gray-300 h-6 rounded-md" style="width: 170px; height: 20px;"></div>
                            <div class="bg-gray-300 h-6 rounded-md" style="width: 150px; height: 20px;"></div>
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
        <!-- </ul> -->
    HTML;
    }

    $output .= '</ul>';

    return $output;
    }

}
