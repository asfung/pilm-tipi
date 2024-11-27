<?php
namespace App\services;

use App\Models\Bookmarks;
use App\Common\ResponJson;
use App\Common\CommonService;
use App\DataTransferObject\TvDTO;
use App\DataTransferObject\MovieDTO;
use App\DataTransferObject\BookmarkDTO;

class BookmarkService extends CommonService{

    public function add(BookmarkDTO $bookmarkDTO){
        try{
            $user = $this->getUser();

            $item_id = $bookmarkDTO->getItem_id();
            $item_type = $bookmarkDTO->getItem_type();

            $isExist = isBookmarkExist($user->id, $item_id);
            if($isExist){
                $delete = deleteBookmark($user->id, $item_id);
                $response = new ResponJson(200, 'Data Berhasil Dihapus', $delete, null);
                // $isExist->delete();
                // $response = new ResponJson(409, 'Conflict', "Data Is Already exist in database", 'Duplicate Raw');
                // return $response->getResponse();
                return $response->getResponse();
            }

            // $bookmark = new Bookmarks([
            //     'id_user' => $user->id,
            //     'name_user' => $user->name,
            //     'item_id' => $item_id,
            //     'item_type' => $item_type,
            // ]);
            $bookmark = new Bookmarks();
            $bookmark->id_user = $user->id;
            $bookmark->name_user = $user->name;
            $bookmark->item_id = $item_id;
            $bookmark->item_type = $item_type;
            $bookmark->save();

            $response = new ResponJson(200, 'Data Berhasil Ditambahkan', $bookmark, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

    public function remove(BookmarkDTO $bookmarkDTO){
        try{
            $user = $this->getUser();
            $item_id = $bookmarkDTO->getItem_id();
            $item_type = $bookmarkDTO->getItem_type();

            $bookmark = Bookmarks::where('id_user', $user->id)
                ->where('item_id', $item_id)
                ->where('item_type', $item_type);
            $bookmark->delete();

            $response = new ResponJson(200, 'Data Berhasil Dihapus', $bookmark, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

    public function getBookmark(BookmarkDTO $bookmarkDTO){
        try{
            $user = $this->getUser();
            $page = $bookmarkDTO->getPage();
            $limit = $bookmarkDTO->getLimit() ?? 10;

            $bookmarks = Bookmarks::where('id_user', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($limit, '*', 'page', $page);

            // $response = new ResponJson(200, 'Berhasil', $bookmarks, null);
            // return $response->getResponse();

            $data = [];
            foreach ($bookmarks as $bookmark) {
                if ($bookmark->item_type == 'movie') {
                    $movieDTO = new MovieDTO();
                    $movieDTO->setId($bookmark->item_id);
                    $movie = $this->getMovieById($movieDTO);
                    // $movie['vote_average'] = round($movie['vote_average'] / 2, 0);
                    $data[] = array_merge($bookmark->toArray(), ['data' => $movie]);
                } elseif ($bookmark->item_type == 'tv') {
                    $tvDTO = new TvDTO();
                    $tvDTO->setId($bookmark->item_id);
                    $tv = $this->getTvById($tvDTO);
                    // $tv['vote_average'] = round($tv['vote_average'] / 2, 0);
                    $data[] = array_merge($bookmark->toArray(), ['data' => $tv]);
                }
            }

            $response = new ResponJson(200, 'Berhasil', $data, null);
            return $response->getResponse();
    
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

    private function getMovieById(MovieDTO $movieDTO){
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

            return $data_film;
            // return response()->json($data_film, 200);
        }catch(\Exception $e){
            return $e->getMessage();
            // return response()->json($e->getMessage(), 500);
        }
    }

    private function getTvById(TvDTO $tvDTO){
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

            // return response()->json($data_tv, 200);
            return $data_tv;
        }catch(\Exception $e){
            return $e->getMessage();
            // return response()->json($e->getMessage(), 500);
        }
    }

}