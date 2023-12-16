<?php

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
