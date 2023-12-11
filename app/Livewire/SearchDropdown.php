<?php

namespace App\Livewire;

use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $client =  new \GuzzleHttp\Client();

        $searchResults = [];

        $response = $client->request('GET', config('services.tmdb.endpoint') . 'search/movie?query=' . $this->search . '&api_key=' .  config('services.tmdb.api'), [
            'headers' => [
            'Authorization' => config('servies.tmdb.auth'),
            'accept' => 'application/json',
            ],
        ]);
        $searchResults = json_decode($response->getBody(), true);

        return view('livewire.search-dropdown', [
            'searchResults' => $searchResults
        ]);
    }
}
