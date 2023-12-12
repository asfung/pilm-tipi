<?php

namespace App\Livewire;

use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $width;

    public function render()
    {
        $client =  new \GuzzleHttp\Client();

        $response_movie = $client->request('GET', config('services.tmdb.endpoint') . 'search/movie?query=' . $this->search . '&api_key=' .  config('services.tmdb.api'), [
            'headers' => [
            'Authorization' => config('servies.tmdb.auth'),
            'accept' => 'application/json',
            ],
        ]);


        $response_tv = $client->request('GET', config('services.tmdb.endpoint') . 'search/tv?query=' . $this->search . '&api_key=' .  config('services.tmdb.api'), [
            'headers' => [
            'Authorization' => config('servies.tmdb.auth'),
            'accept' => 'application/json',
            ],
        ]);


        $searchResults_movie = json_decode($response_movie->getBody(), true);
        $searchResults_tv = json_decode($response_tv->getBody(), true);

        return view('livewire.search-dropdown', [
            'searchResults_movie' => $searchResults_movie,
            'searchResults_tv' => $searchResults_tv
        ]);
    }
}
