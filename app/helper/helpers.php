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
  // $data = Cache::remember('bmrkfetch_', now()->addMinutes(60), function(){
    // $data = BookmarksModel::all(); => BEFORE
    // return BookmarksModel::all();
    // return BookmarksModel::orderBy('created_at', 'desc')->get();
    // return BookmarksModel::latest()->get();
  // });
  // return $data;

  $data = Cache::remember('bmrkfetch_', now()->addMinutes(60), function(){
    return BookmarksModel::orderBy('created_at', 'desc')->get();
  });

  $cachedCount = $data->count();
  $modelCount = BookmarksModel::count();

  if ($cachedCount < $modelCount) {
    return BookmarksModel::orderBy('created_at', 'desc')->get();
  }

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
}

// this is bad just using user_id not using the name because the name is not unique as email
function getBookmark($id_user, $item_id){
  $result = BookmarksModel::where('id_user', $id_user)->where('item_id', $item_id);
  return $result;
}

function isBookmarkExist($id_user, $item_id){
  $result = BookmarksModel::where('id_user', $id_user)->where('item_id', $item_id)->exists();
  return $result;
}

function deleteBookmark($id_user, $item_id){
  $bookmark = BookmarksModel::where('id_user',$id_user)->where('item_id', $item_id)->delete();
  return $bookmark;
}