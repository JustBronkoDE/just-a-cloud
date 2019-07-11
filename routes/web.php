<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Homepage
 */
Route::get('/', function () {
	if (Auth::user()) {
		return redirect('/home');
	}
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'PageController@index');
//Exeptions 
Route::get('/404', function ()
{
	return view('exceptions.404');
});
Route::get('/500', function ()
{
	return view('exceptions.500');
});

// Page::routes(); @todo create Route Collection
Route::get('/files', 'PageController@files');
Route::get('/files/{file}', 'PageController@file');

// Cloud::routes(); @todo create Route Collection
Route::post('/cloud/store', 'Cloud\CloudController@store');
Route::get('/cloud/download/{file}', 'Cloud\CloudController@download');
Route::post('/cloud/delete/{file}', 'Cloud\CloudController@delete');
Route::get('/files/{file}/public/toggle', 'Cloud\CloudController@togglePublic');

// Chat::routes(); @todo create Chat Route Collection
Route::post('/chats/new/chat', 'Chats\ChatsController@createChat');
Route::post('/chats/new/message', 'Chats\ChatsController@newMessage');
Route::post('/chats/users/search', 'Chats\ChatsController@searchChatUsers');
Route::post('/chats/updates', 'Chats\ChatsController@getUpdates');

// User::routes(); @todo create User Route Collection
Route::get('/users', 'PageController@users');
Route::get('/users/{user}', 'PageController@user');
Route::get('/users/{user}/profile/edit', 'User\UserController@edit');
Route::get('/users/{user}/profile/image', 'User\UserController@downloadImage');
Route::post('/users/{user}/profile/update', 'User\UserController@update');

//Get Music from Cloud

//Get Videos from Cloud