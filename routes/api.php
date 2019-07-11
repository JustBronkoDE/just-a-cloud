<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//@todo Create route collection for api routes

//Audio Routes @todo make post out of it
Route::get('/audios', 'Api\AudioController@getAudios');
Route::get('/audio/{file}', 'Api\AudioController@getAudio');

//Video Routes @todo make post out of it
Route::get('/videos', 'Api\VideoController@getVideos');
Route::get('/video/{file}', 'Api\VideoController@getVideo');

//Image Routes @todo make post out of it
Route::get('/images', 'Api\ImageController@getImages');
Route::get('/image/{file}', 'Api\ImageController@getImage');
