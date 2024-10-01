<?php
namespace App\services;

use App\Common\ResponJson;
use App\Common\CommonService;
use App\DataTransferObject\MultiDTO;

class MultiService extends CommonService{


    public function multiSearch(MultiDTO $multiDTO){
        try{
            $user = $this->getUser();
            $q = $multiDTO->getQ();
            $page = is_null($multiDTO->getPage()) ? 1 : $multiDTO->getPage();
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', config('services.tmdb.endpoint') . 'search/multi?query=' . $q . '&page=' . $page . '&language=en-US' , [
                'headers' => [
                'Authorization' => config('services.tmdb.auth'),
                'accept' => 'application/json',
                ],
            ]);
            $data = json_decode($response->getBody(), true);

            $response = new ResponJson(200, 'Berhasil', $data, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }
}