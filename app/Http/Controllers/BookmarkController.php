<?php

namespace App\Http\Controllers;

use App\DataTransferObject\BookmarkDTO;
use App\services\BookmarkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class BookmarkController extends Controller
{
    private $bookmarkService;
    public function __construct(){
        $this->bookmarkService = new BookmarkService();
    }

    /**
     * @OA\Post(
     *     path="/api/1/bookmark/Create",
     *     tags={"Bookmarks"},
     *     summary="Create a bookmark",
     *     description="Allows a user to bookmark an item.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"item_id", "item_type"},
     *             @OA\Property(property="item_id", type="integer"),
     *             @OA\Property(property="item_type", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bookmark created"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/1/bookmark/Delete",
     *     tags={"Bookmarks"},
     *     summary="Delete a bookmark",
     *     description="Allows a user to remove a bookmark.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"item_id", "item_type"},
     *             @OA\Property(property="item_id", type="integer"),
     *             @OA\Property(property="item_type", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bookmark deleted"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
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

    
    /**
     * @OA\Get(
     *     path="/api/1/bookmark",
     *     tags={"Bookmarks"},
     *     summary="Get user bookmarks",
     *     description="Returns a list of the user's bookmarked items.",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of bookmarks"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
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
