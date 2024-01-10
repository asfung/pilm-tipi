<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MoviesTvShowsController extends Controller
{
    public function index(){
        $client = new \GuzzleHttp\Client();
        $http_id_value = Http::class;

        $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/popular?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
            'headers' => [
              'Authorization' => config('services.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

        $data_film = json_decode($response->getBody(), true);

        // FIXED but not in here
        // $get_data_value = Http::asJson()->get(config('services.tmdb.endpoint') . 'movie/' . $data_film['results'][0]['id'] . '?api_key=' . config('services.tmdb.api'));

          // tv shows
        // $client = new \GuzzleHttp\Client();

        // udh gk perlu lagi, byeee...
        // $responseTv = $client->request('GET', config('services.tmdb.endpoint') . 'trending/tv/week?include_adult=false&include_null_first_air_dates=false&language=en-US&page=1&sort_by=popularity.desc' . '&api_key=' . config('services.tmdb.api'), [
        //       'headers' => [
        //       'Authorization' => config('services.tmdb.auth'),
        //       'accept' => 'application/json',
        //     ],
        //   ]);

    
        // $tvShows = json_decode($responseTv->getBody(), true);

        return view('index', compact('data_film', 'http_id_value'));

    }
    
    public function movieDetail($id){

      // i think its fine if not cachinging this function, absolutely NO! 
      $client = new \GuzzleHttp\Client();
      $cache_key = 'movieDetails_' . $id;

      if(Cache::has($cache_key)){
        return view('movie-details', [
          'movieDetails' => Cache::get($cache_key)['movieDetails'],
          'movieTrailers' => Cache::get($cache_key)['movieTrailers'],
      ]);
      }

      $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?include_adult=false&language=en-US&append_to_response=credits' . '&api_key=' . config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('services.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      $response_trailer = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '/videos?include_adult=false&language=en-US&append_to_response=credits' . '&api_key=' . config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('services.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      // later....
      $statusCode_1 = $response->getStatusCode();
      $statusCode_2 = $response_trailer->getStatusCode();

      // if($statusCode_1 == 200 && $statusCode_2 == 200){
      //   //   return view('movie-details', [
      //   //     'movieDetails' => Cache::get($cache_key)['movieDetails'],
      //   //     'movieTrailers' => Cache::get($cache_key)['movieTrailers'],
      //   //  ]);
      //     $cachedData = [
      //       'movieDetails' => json_decode($response->getBody(), true),
      //       'movieTrailers' => json_decode($response_trailer->getBody(), true),
      //     ];
      //     Cache::put($cache_key, $cachedData, now()->addMinutes(60));
      //   return view('movie-details', $cachedData);
      // }else{
      //   switch($statusCode_1){
      //     case 401:
      //       return view('errors.401');
      //     break;
      //     case 402:
      //       return view('errors.402');
      //     break;
      //     case 403:
      //       return view('errors.403');
      //     break;
      //     case 404:
      //       return view('errors.404');
      //     break;
      //     case 419:
      //       return view('errors.419');
      //     break;
      //     case 429:
      //       return view('errors.429');
      //     break;
      //     case 500:
      //       return view('errors.500');
      //     break;
      //     case 503:
      //       return view('errors.503');
      //     break;
      //     default: 
      //       return view('errors.404');
      //   }
      // }

      // $data_film = json_decode($response->getBody(), true);
      $cachedData = [
        'movieDetails' => json_decode($response->getBody(), true),
        'movieTrailers' => json_decode($response_trailer->getBody(), true),
      ];
      Cache::put($cache_key, $cachedData, now()->addMinutes(60));
      

      // return view('movie-details', [
      //   'movieDetails' => json_decode($response->getBody(), true),
      //   'movieTrailers' => json_decode($response_trailer->getBody(), true)
      // ]);
      return view('movie-details', $cachedData);
    }

    public function tvDetail($id){
      $client =  new \GuzzleHttp\Client();

      $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?language=en-US' . '&api_key=' .  config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('services.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      return view('tv-details', ['tvDetails' => json_decode($response->getBody(), true)]);

    }



}
