<?php

/**
 * @OA\Info(
 *     title="Movie and TV API",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="your-email@example.com",
 *         name="Your Name"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication endpoints"
 * )
 */

/**
 * @OA\Tag(
 *     name="Movies",
 *     description="Movie endpoints"
 * )
 */

/**
 * @OA\Tag(
 *     name="TV Shows",
 *     description="TV Show endpoints"
 * )
 */

/**
 * @OA\Tag(
 *     name="Bookmarks",
 *     description="Bookmark endpoints"
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/register",
 *     @OA\Post(
 *         tags={"Auth"},
 *         summary="Register a new user",
 *         @OA\RequestBody(
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                     description="User name"
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     description="User email"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                     description="User password"
 *                 )
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response"
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/login",
 *     @OA\Post(
 *         tags={"Auth"},
 *         summary="Login a user",
 *         @OA\RequestBody(
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     description="User email"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                     description="User password"
 *                 )
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response"
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/logout",
 *     @OA\Post(
 *         tags={"Auth"},
 *         summary="Logout a user",
 *         @OA\Response(
 *             response=200,
 *             description="Successful response"
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/me",
 *     @OA\Get(
 *         tags={"Auth"},
 *         summary="Get the current user",
 *         @OA\Response(
 *             response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer"
 *                 ),
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 )
 *             )
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/movie/popular",
 *     @OA\Get(
 *         tags={"Movies"},
 *         summary="Get popular movies",
 *         @OA\Parameter(
 *             name="page",
 *             in="query",
 *             description="Page number",
 *             required=false,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="results",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(
 *                             property="id",
 *                             type="integer"
 *                         ),
 *                         @OA\Property(
 *                             property="title",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="overview",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="poster_path",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="release_date",
 *                             type="string"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/movie/{id}",
 *     @OA\Get(
 *         tags={"Movies"},
 *         summary="Get a movie by ID",
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Movie ID",
 *             required=true,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer"
 *                 ),
 *                 @OA\Property(
 *                     property="title",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="overview",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="poster_path",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="release_date",
 *                     type="string"
 *                 )
 *             )
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/tv/popular",
 *     @OA\Get(
 *         tags={"TV Shows"},
 *         summary="Get popular TV shows",
 *         @OA\Parameter(
 *             name="page",
 *             in="query",
 *             description="Page number",
 *             required=false,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="results",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(
 *                             property="id",
 *                             type="integer"
 *                         ),
 *                         @OA\Property(
 *                             property="name",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="overview",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="poster_path",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="first_air_date",
 *                             type="string"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/tv/{id}",
 *     @OA\Get(
 *         tags={"TV Shows"},
 *         summary="Get a TV show by ID",
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="TV show ID",
 *             required=true,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer"
 *                 ),
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="overview",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="poster_path",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="first_air_date",
 *                     type="string"
 *                 )
 *             )
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/bookmark",
 *     @OA\Get(
 *         tags={"Bookmarks"},
 *         summary="Get bookmarks",
 *         @OA\Response(
 * response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="results",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(
 *                             property="id",
 *                             type="integer"
 *                         ),
 *                         @OA\Property(
 *                             property="title",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="overview",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="poster_path",
 *                             type="string"
 *                         ),
 *                         @OA\Property(
 *                             property="release_date",
 *                             type="string"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */

/**
 * @OA\PathItem(
 *     path="/1/bookmark/{id}",
 *     @OA\Get(
 *         tags={"Bookmarks"},
 *         summary="Get a bookmark by ID",
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Bookmark ID",
 *             required=true,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *         @OA\Response(
 *             response=200,
 *             description="Successful response",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer"
 *                 ),
 *                 @OA\Property(
 *                     property="title",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="overview",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="poster_path",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="release_date",
 *                     type="string"
 *                 )
 *             )
 *         )
 *     )
 * )
 */