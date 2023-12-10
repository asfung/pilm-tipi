<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MoviesTvShowsController extends Controller
{
    public function index(){
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/popular?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
            'headers' => [
              'Authorization' => config('servies.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

        $data_film = json_decode($response->getBody(), true);

        // still not fixed
        $get_data_value = Http::asJson()->get(config('services.tmdb.endpoint') . 'movie/' . $data_film['results'][0]['id'] . '?api_key=' . config('services.tmdb.api'));

          // tv shows
        // $client = new \GuzzleHttp\Client();

        $responseTv = $client->request('GET', config('services.tmdb.endpoint') . '/discover/tv?include_adult=false&include_null_first_air_dates=false&language=en-US&page=1&sort_by=popularity.desc' . '&api_key=' . config('services.tmdb.api'), [
              'headers' => [
              'Authorization' => config('servies.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

    
    $tvShows = json_decode($responseTv->getBody(), true);

        return view('index', compact('data_film', 'get_data_value', 'tvShows'));

    }
    
    public function movieDetail($id){
    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
      'headers' => [
        'Authorization' => config('servies.tmdb.auth'),
        'accept' => 'application/json',
      ],
    ]);

    
    // $data_film = json_decode($response->getBody(), true);
        
    return view('movie-details', ['movieDetails' => json_decode($response->getBody(), true)]);
    }

    public function tvDetail($id){
      $client =  new \GuzzleHttp\Client();

      $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?include_adult=false&language=en-US' . '&api_key=' .  config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('servies.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      return view('tv-details', ['tvDetails' => json_decode($response->getBody(), true)]);

    }



}
