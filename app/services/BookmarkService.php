<?php
namespace App\services;

use App\Common\ResponJson;
use App\Common\CommonService;
use App\DataTransferObject\BookmarkDTO;
use App\Models\Bookmarks;

class BookmarkService extends CommonService{

    public function add(BookmarkDTO $bookmarkDTO){
        try{
            $user = $this->getUser();

            $item_id = $bookmarkDTO->getItem_id();
            $item_type = $bookmarkDTO->getItem_type();

            $isExist = isBookmarkExist($user->id, $item_id);
            if($isExist){
                $response = new ResponJson(409, 'Conflict', "Data Is Already exist in database", 'Duplicate Raw');
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
            // $bookmark->save();

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
            ->paginate($limit, '*', 'page', $page);

            $response = new ResponJson(200, 'Berhasil', $bookmarks, null);
            return $response->getResponse();
        }catch(\Exception $e){
            $response = new ResponJson(500, 'Error Server', null, $e->getMessage());
            return $response->getResponse();
        }
    }

}