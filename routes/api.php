<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

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

//===== SPECIFC USER'S INFO =====
Route::group(['middleware' => 'apiAuth', 'prefix' => 'user', 'namespace' => 'API', 'name' => 'user.'], function (){

    //===== MANAGE USER INFO =====
    Route::get('/', 'UserController@show')->name('index');
    Route::put('/', 'UserController@update')->name('update');
    Route::delete('/delete-account', 'UserController@destroy')->name('delete-account');

    //===== USER'S POSTS =====
    Route::post('/post', 'UserController@createPost')->name('add-post');
    Route::delete('/post/{postIds}', 'UserController@deletePost')->name('delete-post');
    Route::put('/post/{postId}', 'UserController@updatePost')->name('update-post');


    Route::get('/buys', 'PostBuyController@showUserPosts')->name('all-buys');
    Route::get('/buys/category/{catId}', 'PostBuyController@showUserPostsByCategory')->name('all-buys-by-cat');
    Route::get('/buy/{id}', 'PostBuyController@show')->name('single-buy');
    Route::put('/buy/{id}', 'PostBuyController@update')->name('update-buy');

    Route::get('/sells', 'PostSellController@showUserPosts')->name('all-sells');
    Route::get('/sells/category/{catId}', 'PostSellController@showUserPostsByCategory')->name('all-sells-by-cat');
    Route::get('/sell/{id}', 'PostSellController@show')->name('single-sell');

    //===== USER'S FAVORITE POSTS =====
    Route::get('/favotites', 'UserController@getFavtorites')->name('favorites');
    Route::delete('/favotites/{postIds}', 'UserController@removeFavtorites')->name('delete-favorites');


});

//===== ALL USERS =====
Route::group([ 'prefix' => 'users', 'namespace' => 'API', 'name' => 'user.'], function (){
    Route::get('/', 'UserController@index')->name('getAllUsers');
});

//===== ALL BUY POSTS =====
Route::group([ 'prefix' => 'buys', 'namespace' => 'API', 'name' => 'buys.'], function (){
    Route::get('/', 'PostBuyController@index')->name('getAllBuys');
    Route::get('/category/{catId}', 'PostBuyController@showAllByCategory')->name('getAllBuysByCat');
});

//===== ALL SELL POSTS =====
Route::group([ 'prefix' => 'sells', 'namespace' => 'API', 'name' => 'sells.'], function (){
    Route::get('/', 'PostSellController@index')->name('getAllSells');
    Route::get('/category/{catId}', 'PostSellController@index')->name('getAllSellsByCat');
});

//===== IMAGES =====
Route::group([ 'middleware' => 'apiAuth', 'prefix' => 'images', 'namespace' => 'API', 'name' => 'images.'], function (){
    Route::post('/profile', 'ImageUploadController@uploadProfileImage')->name('profile');
    Route::post('/post', 'ImageUploadController@uploadPostImage')->name('post');
});


Route::post('/logout', 'MainController@logout_acc');
