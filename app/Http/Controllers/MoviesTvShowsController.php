<?php

namespace App\Http\Controllers;

use App\Common\CommonDTO;
use App\DataTransferObject\MovieDTO;
use App\DataTransferObject\MultiDTO;
use App\DataTransferObject\TvDTO;
use Illuminate\Http\Request;
use App\services\MoviesService;
use App\services\MultiService;
use App\services\TvsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\UnauthorizedException;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Movies and TV Shows API", version="1.0")
 */
class MoviesTvShowsController extends Controller
{

  private $movieService;
  private $tvService;
  private $multiService;
  public function __construct()
  {
    $this->movieService = new MoviesService();
    $this->tvService = new TvsService();
    $this->multiService = new MultiService();
  }

    public function index($page = 1){
        $client = new \GuzzleHttp\Client();
        $http_id_value = Http::class;

        $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/popular?include_adult=false&language=en-US' . '&api_key=' . config('services.tmdb.api'), [
            'headers' => [
              'Authorization' => config('services.tmdb.auth'),
              'accept' => 'application/json',
            ],
          ]);

        $data_film = json_decode($response->getBody(), true);

        // $client = new \GuzzleHttp\Client();
        // $http_id_value = Http::class;
        //
        // $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/popular?include_adult=false&language=en-US&page=' . $page . '&api_key=' . config('services.tmdb.api'), [
        //     'headers' => [
        //       'Authorization' => config('services.tmdb.auth'),
        //       'accept' => 'application/json',
        //     ],
        //   ]);
        //
        // $data_film = json_decode($response->getBody(), true);
        //
        // $total_pages = $data_film['total_pages'];
        // $current_page = $page;



        // FIXED but not in here
        // $get_data_value = Http::asJson()->get(config('services.tmdb.endpoint') . 'movie/' . $data_film['results'][0]['id'] . '?api_key=' . config('services.tmdb.api'));

          // tv shows
        // $client = new \GuzzleHttp\Client();

        // udh gk perlu lagi, byeee...
        // $responseTv = $client->request('GET', config('services.tmdb.endpoint') . 'trending/tv/week?include_adult=false&include_null_first_air_dates=false&language=en-US&page=1&sort_by=popularity.desc' . '&api_key=' . config('services.tmdb.api'), [
        //       'headers' => [
        //       'Authorization' => config('services.tmdb.auth'),
        //       'accept' => 'application/json',
        //     ],
        //   ]);


        // $tvShows = json_decode($responseTv->getBody(), true);

        return view('index', compact('data_film', 'http_id_value'));
        // return view('index', compact('data_film', 'http_id_value', 'total_pages', 'current_page'));

    }

    public function movieDetail($id){

      // i think its fine if not cachinging this function, absolutely NO!
      $client = new \GuzzleHttp\Client();
      $cache_key = 'movieDetails_' . $id;

      if(Cache::has($cache_key)){
        return view('movie-details', [
          'movieDetails' => Cache::get($cache_key)['movieDetails'],
          'movieTrailers' => Cache::get($cache_key)['movieTrailers'],
      ]);
      }

      $response = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '?include_adult=false&language=en-US&append_to_response=credits' . '&api_key=' . config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('services.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      $response_trailer = $client->request('GET', config('services.tmdb.endpoint') . 'movie/' . $id . '/videos?include_adult=false&language=en-US&append_to_response=credits' . '&api_key=' . config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('services.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      // later....
      $statusCode_1 = $response->getStatusCode();
      $statusCode_2 = $response_trailer->getStatusCode();

      // if($statusCode_1 == 200 && $statusCode_2 == 200){
      //   //   return view('movie-details', [
      //   //     'movieDetails' => Cache::get($cache_key)['movieDetails'],
      //   //     'movieTrailers' => Cache::get($cache_key)['movieTrailers'],
      //   //  ]);
      //     $cachedData = [
      //       'movieDetails' => json_decode($response->getBody(), true),
      //       'movieTrailers' => json_decode($response_trailer->getBody(), true),
      //     ];
      //     Cache::put($cache_key, $cachedData, now()->addMinutes(60));
      //   return view('movie-details', $cachedData);
      // }else{
      //   switch($statusCode_1){
      //     case 401:
      //       return view('errors.401');
      //     break;
      //     case 402:
      //       return view('errors.402');
      //     break;
      //     case 403:
      //       return view('errors.403');
      //     break;
      //     case 404:
      //       return view('errors.404');
      //     break;
      //     case 419:
      //       return view('errors.419');
      //     break;
      //     case 429:
      //       return view('errors.429');
      //     break;
      //     case 500:
      //       return view('errors.500');
      //     break;
      //     case 503:
      //       return view('errors.503');
      //     break;
      //     default:
      //       return view('errors.404');
      //   }
      // }

      // $data_film = json_decode($response->getBody(), true);
      $cachedData = [
        'movieDetails' => json_decode($response->getBody(), true),
        'movieTrailers' => json_decode($response_trailer->getBody(), true),
      ];
      Cache::put($cache_key, $cachedData, now()->addMinutes(60));


      // return view('movie-details', [
      //   'movieDetails' => json_decode($response->getBody(), true),
      //   'movieTrailers' => json_decode($response_trailer->getBody(), true)
      // ]);
      return view('movie-details', $cachedData);
    }

    public function tvDetail($id){
      $client =  new \GuzzleHttp\Client();

      $response = $client->request('GET', config('services.tmdb.endpoint') . 'tv/' . $id . '?language=en-US' . '&api_key=' .  config('services.tmdb.api'), [
        'headers' => [
          'Authorization' => config('services.tmdb.auth'),
          'accept' => 'application/json',
        ],
      ]);

      return view('tv-details', ['tvDetails' => json_decode($response->getBody(), true)]);

    }

    /**
     * @OA\Get(
     *     path="/api/1/movie/popular",
     *     tags={"Movies"},
     *     summary="Get popular movies",
     *     description="Returns a list of popular movies.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of popular movies"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     @OA\Header(
     *         header="Authorization",
     *         description="Bearer <token>",
     *         required=true
     *     )
     * )
     */
    public function popularMoviesCTLL(Request $request){
      try{
        $user = Auth::guard('api')->user();
        $page_request = $request->input('page');
        $movieDTO = new MovieDTO();
        $movieDTO->setPage($page_request);
        $result = $this->movieService->getPopularMovies($movieDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/1/movie/top_rated",
     *     tags={"Movies"},
     *     summary="Get top-rated movies",
     *     description="Returns a list of top-rated movies.",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of top-rated movies"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function topRatedMoviesCTLL(Request $request){
      try{
        $page_request = $request->input('page');
        $movieDTO = new MovieDTO();
        $movieDTO->setPage($page_request);
        $result = $this->movieService->getTopRatedMovies($movieDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/1/movie/trending",
     *     tags={"Movies"},
     *     summary="Get trending movies",
     *     description="Returns a list of trending movies.",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of trending movies"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function trendingMoviesCTLL(Request $request){
      try{
        $user = Auth::user()->name;
        $page_request = $request->input('page');
        $movieDTO = new MovieDTO();
        $movieDTO->setPage($page_request);
        $result = $this->movieService->getWeeklyTrendMovies($movieDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/1/movie/{id}",
     *     tags={"Movies"},
     *     summary="Get movie by ID",
     *     description="Returns details of a specific movie by its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the movie",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie details"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function getMovieByIdCTLL(Request $request, $id){
      try{
        $user = Auth::user()->name;
        $movieDTO = new MovieDTO();
        $movieDTO->setId($id);
        $result = $this->movieService->getMovieById($movieDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/tv/popular",
     *     tags={"TV Shows"},
     *     summary="Get a list of popular TV shows",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of popular TV shows",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function popularTvsCTLL(Request $request){
      try{
        $page_request = $request->input('page');
        $tvDTO = new TvDTO();
        $tvDTO->setPage($page_request);
        $result = $this->tvService->getPopularTvs($tvDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }


    /**
     * @OA\Get(
     *     path="/api/tv/top_rated",
     *     tags={"TV Shows"},
     *     summary="Get a list of top-rated TV shows",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of top-rated TV shows",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function topRatedTvsCTLL(Request $request){
      try{
        $page_request = $request->input('page');
        $tvDTO = new TvDTO();
        $tvDTO->setPage($page_request);
        $result = $this->tvService->getTopRatedTvs($tvDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/tv/trending",
     *     tags={"TV Shows"},
     *     summary="Get a list of trending TV shows",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of trending TV shows",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function trendingTvsCTLL(Request $request){
      try{
        $page_request = $request->input('page');
        $tvDTO = new TvDTO();
        $tvDTO->setPage($page_request);
        $result = $this->tvService->getWeeklyTrendTvs($tvDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/tv/{id}",
     *     tags={"TV Shows"},
     *     summary="Get a specific TV show by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="TV show ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="TV show details",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="TV show not found"
     *     )
     * )
     */
    public function getTvByIdCTLL(Request $request, $id){
      try{
        $user = Auth::user()->name;
        $tvDTO = new TvDTO();
        $tvDTO->setId($id);
        $result = $this->tvService->getTvById($tvDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }


    public function multiCTLL(Request $request){
      try{
        $user = Auth::user()->name;
        $query = $request->input('q');
        $page = $request->input('page');
        $multiDTO = new MultiDTO();
        $multiDTO->setQ($query);
        $multiDTO->setPage($page);
        $result = $this->multiService->multiSearch($multiDTO);
        return response()->json($result, 200);
      }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
      }
    }

}
