<?php

use App\Livewire\Bookmarks;
use App\Models\Bookmarks as BookmarksModel;

function test($x){
  return dump($x);
}

function getMovieById($id){
  $client = new \GuzzleHttp\Client();

  $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
    'headers' => [
      'Authorization' => config('servies.tmdb.auth'),
      'accept' => 'application/json',
    ],
  ]);

  $data = json_decode($response->getBody(), true);

  return $data;
}

function getTvById($id){
  $client =  new \GuzzleHttp\Client();

  $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?include_adult=false&language=en-US' . '&api_key=' .  config('services.tmdb.api'), [
    'headers' => [
      'Authorization' => config('servies.tmdb.auth'),
      'accept' => 'application/json',
    ],
  ]);
  $data = json_decode($response->getBody(), true);

  return $data;
}

function getAllBookmark(){
  $data = BookmarksModel::all();
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
