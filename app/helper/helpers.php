<?php

use App\Models\Bookmarks as BookmarksModel;
use Illuminate\Support\Facades\Auth;
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
}

function getTvByArray($ids){

  $cacheKey = 'arrTvs' . implode('_', $ids);

  $split_str = explode('arrTvs', $cacheKey);
  $split_str_toInt = (int) $split_str[1];
  $datas_table = BookmarksModel::all()->where('name_user', Auth::user()->name)->where('item_type', 'tv')->toArray();
  // casting string to int
  // dump($split_str_toInt);
  // dump(gettype($split_str_toInt));
  foreach($datas_table as $data){
    // dump($data['item_id']);
    if($split_str_toInt !== $data['item_id']){
      Cache::forget($cacheKey);
    }
  }

  $tvs = Cache::remember($cacheKey, now()->addMinutes(60), function() use ($ids){
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
