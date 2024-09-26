<?php

namespace App\Http\Controllers;

use App\DataTransferObject\BookmarkDTO;
use App\services\BookmarkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    private $bookmarkService;
    public function __construct(){
        $this->bookmarkService = new BookmarkService();
    }

    public function storeCTLL(Request $request){
      try{
        $user = Auth::user()->name;
        $item_id = $request->input('item_id');
        $item_type = $request->input('item_type');
        $bookmarkDto = new BookmarkDTO();
        $bookmarkDto->setItem_id($item_id);
        $bookmarkDto->setItem_type($item_type);

        $result = $this->bookmarkService->add($bookmarkDto);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    public function deleteCTLL(Request $request){
      try{
        $user = Auth::user()->name;
        $item_id = $request->input('item_id');
        $item_type = $request->input('item_type');
        $bookmarkDto = new BookmarkDTO();
        $bookmarkDto->setItem_id($item_id);
        $bookmarkDto->setItem_type($item_type);

        $result = $this->bookmarkService->remove($bookmarkDto);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    public function getBookmarkCTLL(Request $request){
      try{
        $user = Auth::user()->name;
        $page_request = $request->input('page') ? $request->input('page') : null;
        $limit_request = $request->input('limit') ? $request->input('limit') : null;
        $bookmarkDto = new BookmarkDTO();
        $bookmarkDto->setPage($page_request);
        $bookmarkDto->setLimit($limit_request);

        $result = $this->bookmarkService->getBookmark($bookmarkDto);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }
}
