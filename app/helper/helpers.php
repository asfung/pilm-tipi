<?php

use App\Models\Bookmarks as BookmarksModel;
use Illuminate\Support\Facades\Cache;

function test($x){
  return dump($x);
}

function getMovieById($id){

  $data = Cache::remember('movie_' . $id, now()->addMinutes(60), function() use ($id){

    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
      'headers' => [
        'Authorization' => config('servies.tmdb.auth'),
        'accept' => 'application/json',
      ],
    ]);

    // $data = json_decode($response->getBody(), true);
    return json_decode($response->getBody(), true);
  });

  return $data;
}

function getTvById($id){

  $data = Cache::remember('tv_' . $id, now()->addMinutes(60), function() use ($id){
    $client =  new \GuzzleHttp\Client();
    $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?include_adult=false&language=en-US' . '&api_key=' .  config('services.tmdb.api'), [
      'headers' => [
        'Authorization' => config('servies.tmdb.auth'),
        'accept' => 'application/json',
      ],
    ]);
    // $data = json_decode($response->getBody(), true);
    return json_decode($response->getBody(), true);
  });

  return $data;
}

function getAllBookmark(){
  $data = Cache::remember('bmrkfetch_', now()->addMinutes(60), function(){
    // $data = BookmarksModel::all(); => BEFORE
    return BookmarksModel::all();
  });
  return $data;
}


function getMovieByArray($ids){

  // array to string single = https://tinkerwell.app/blog/how-to-use-implode-in-php#:~:text=The%20implode()%20function%20in,you%20want%20to%20join%20together.
  $movies = Cache::remember('arrMovies_' . implode('_' , $ids), now()->addMinutes(60), function() use ($ids){

    $client = new \GuzzleHttp\Client();
    $movies = [];
    foreach ($ids as $id) {
      $response = null;
      if (BookmarksModel::where('item_id', $id)->where('item_type', 'movie')->first()) {
        $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
          'headers' => [
            'Authorization' => config('services.tmdb.auth'),
            'accept' => 'application/json',
          ],
        ]);
      }

      // cek response jika not null
      if ($response) {
        $data = json_decode($response->getBody(), true);
        $movies[] = $data;
      }
    }
    return $movies;
  });

  return $movies;
}

function getTvByArray($ids){
  
  $tvs = Cache::remember('arrTvs_' . implode('_', $ids), now()->addMinutes(60), function() use ($ids){
    $client = new \GuzzleHttp\Client();
    $tvs = [];
    foreach ($ids as $id) {
      $response = null;
      if(BookmarksModel::where('item_id', $id)->where('item_type', 'tv')->first()){
        $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
          'headers' => [
            'Authorization' => config('services.tmdb.auth'),
            'accept' => 'application/json',
          ],
        ]);
      }

      // cek response jika not null
      if ($response) {
        $data = json_decode($response->getBody(), true);
        $tvs[] = $data;
      }
    }
    return $tvs;
  });

  return $tvs;
}
