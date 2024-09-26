<?php
namespace App\services;

use App\Common\CommonService;
use App\Common\ResponJson;
use App\DataTransferObject\MovieDTO;
use Illuminate\Support\Facades\Http;

class MoviesService extends CommonService{

    public function getPopularMovies(MovieDTO $movieDTO){
        try{
            $user = $this->getUser();

            $page = is_null($movieDTO->getPage()) ? 1 : $movieDTO->getPage();
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/popular?include_adult=false&language=en-US&page=' . $page, [
                'headers' => [
                'Authorization' => config('services.tmdb.auth'),
                'accept' => 'application/json',
                ],
            ]);
            $data_film = json_decode($response->getBody(), true);

            foreach ($data_film['results'] as &$movie) {
                $bookmark = getBookmark($user['id'], $movie['id']);
                $movie['isBookmarked'] = $bookmark->exists();
            }

            $response = new ResponJson(200, 'Berhasil', $data_film, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

    public function getTopRatedMovies(MovieDTO $movieDTO){
        try{
            $user = $this->getUser();

            $page = is_null($movieDTO->getPage()) ? 1 : $movieDTO->getPage();
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/top_rated?include_adult=false&language=en-US&page=' . $page, [
                'headers' => [
                'Authorization' => config('services.tmdb.auth'),
                'accept' => 'application/json',
                ],
            ]);
            $data_film = json_decode($response->getBody(), true);

            foreach ($data_film['results'] as &$movie) {
                $bookmark = getBookmark($user['id'], $movie['id']);
                $movie['isBookmarked'] = $bookmark->exists();
            }

            $response = new ResponJson(200, 'Berhasil', $data_film, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }


    public function getWeeklyTrendMovies(MovieDTO $movieDTO){
        try{
            $user = $this->getUser();

            $page = is_null($movieDTO->getPage()) ? 1 : $movieDTO->getPage();
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', config('services.tmdb.endpoint') . 'trending/movie/week?include_adult=false&language=en-US&page=' . $page, [
                'headers' => [
                'Authorization' => config('services.tmdb.auth'),
                'accept' => 'application/json',
                ],
            ]);
            $data_film = json_decode($response->getBody(), true);

            foreach ($data_film['results'] as &$movie) {
                $bookmark = getBookmark($user['id'], $movie['id']);
                $movie['isBookmarked'] = $bookmark->exists();
            }

            $response = new ResponJson(200, 'Berhasil', $data_film, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }


    public function getMovieById(MovieDTO $movieDTO){
        try{
            $user = $this->getUser();
            $id = $movieDTO->getId();
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?language=en-US' , [
                'headers' => [
                'Authorization' => config('services.tmdb.auth'),
                'accept' => 'application/json',
                ],
            ]);
            $data_film = json_decode($response->getBody(), true);
            $bookmark = getBookmark($user['id'], $data_film['id']);
            $data_film['isBookmarked'] = $bookmark->exists();

            $response = new ResponJson(200, 'Berhasil', $data_film, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }
}
