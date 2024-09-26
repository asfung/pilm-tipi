<?php
namespace App\services;

use App\Common\CommonService;
use App\Common\ResponJson;
use App\DataTransferObject\TvDTO;

class TvsService extends CommonService{

    public function getPopularTvs(TvDTO $tvDTO){
        try{
            $user = $this->getUser();
            $page = is_null($tvDTO->getPage()) ? 1 : $tvDTO->getPage();

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/popular?include_adult=false&language=en-US&sort_by=popularity.desc&page=' . $page . '&api_key=' . config('services.tmdb.api'), [
                'headers' => [
                    'Authorization' => config('servies.tmdb.auth'),
                    'accept' => 'application/json',
                ],
            ]);

            $data_tvs = json_decode($response->getBody(), true);

            foreach ($data_tvs['results'] as &$tv) {
                $bookmark = getBookmark($user['id'], $tv['id']);
                $tv['isBookmarked'] = $bookmark->exists();
            }


            $response = new ResponJson(200, 'Berhasil', $data_tvs, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

    public function getTopRatedTvs(TvDTO $tvDTO){
        try{
            $user = $this->getUser();
            $page = is_null($tvDTO->getPage()) ? 1 : $tvDTO->getPage();

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/top_rated?include_adult=false&language=en-US&sort_by=popularity.desc&page=' . $page . '&api_key=' . config('services.tmdb.api'), [
                'headers' => [
                    'Authorization' => config('servies.tmdb.auth'),
                    'accept' => 'application/json',
                ],
            ]);

            $data_tvs = json_decode($response->getBody(), true);

            foreach ($data_tvs['results'] as &$tv) {
                $bookmark = getBookmark($user['id'], $tv['id']);
                $tv['isBookmarked'] = $bookmark->exists();
            }


            $response = new ResponJson(200, 'Berhasil', $data_tvs, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }


    public function getWeeklyTrendTvs(TvDTO $tvDTO){
        try{
            $user = $this->getUser();
            $page = is_null($tvDTO->getPage()) ? 1 : $tvDTO->getPage();

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('services.tmdb.endpoint') . 'trending/tv/week?include_adult=false&language=en-US&sort_by=popularity.desc&page=' . $page . '&api_key=' . config('services.tmdb.api'), [
                'headers' => [
                    'Authorization' => config('servies.tmdb.auth'),
                    'accept' => 'application/json',
                ],
            ]);

            $data_tvs = json_decode($response->getBody(), true);

            foreach ($data_tvs['results'] as &$tv) {
                $bookmark = getBookmark($user['id'], $tv['id']);
                $tv['isBookmarked'] = $bookmark->exists();
            }


            $response = new ResponJson(200, 'Berhasil', $data_tvs, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }


    public function getTvById(TvDTO $tvDTO){
        try{
            $user = $this->getUser();
            $page = is_null($tvDTO->getPage()) ? 1 : $tvDTO->getPage();
            $id = $tvDTO->getId();
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?language=en-US&api_key=' . config('services.tmdb.api'), [
                'headers' => [
                    'Authorization' => config('servies.tmdb.auth'),
                    'accept' => 'application/json',
                ],
            ]);
            $data_tv = json_decode($response->getBody(), true);
            $bookmark = getBookmark($user['id'], $data_tv['id']);
            $data_tv['isBookmarked'] = $bookmark->exists();

            $response = new ResponJson(200, 'Berhasil', $data_tv, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

}