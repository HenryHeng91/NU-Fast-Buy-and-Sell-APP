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
    Route::post('/post', 'UserController@createPost')->name('add-post');
    Route::delete('/delete-account', 'UserController@destroy')->name('delete-account');

    //===== USER'S POSTS =====
    Route::get('/buys', 'PostBuyController@showUserPosts')->name('all-buys');
    Route::get('/buys/category/{catId}', 'PostBuyController@showUserPostsByCategory')->name('all-buys-by-cat');
    Route::get('/buy/{id}', 'PostBuyController@show')->name('single-buy');
    Route::delete('/buy/{id}', 'PostBuyController@show')->name('single-buy');
    Route::get('/sells', 'PostSellController@showUserPosts')->name('all-sells');
    Route::get('/sells/category/{catId}', 'PostSellController@showUserPostsByCategory')->name('all-sells-by-cat');
    Route::get('/sell/{id}', 'PostSellController@show')->name('single-sell');
});

//===== ALL USERS =====
Route::group([ 'prefix' => 'users', 'namespace' => 'API', 'name' => 'user.'], function (){
    Route::get('/users', 'UserController@index')->name('getAllUsers');
});

//===== ALL BUY POSTS =====
Route::group([ 'prefix' => 'buys', 'namespace' => 'API', 'name' => 'buys.'], function (){
    Route::get('/buys', 'PostBuyController@index')->name('getAllBuys');
    Route::get('/buys/category/{catId}', 'PostBuyController@showAllByCategory')->name('getAllBuysByCat');
});

//===== ALL SELL POSTS =====
Route::group([ 'prefix' => 'sells', 'namespace' => 'API', 'name' => 'sells.'], function (){
    Route::get('/sells', 'PostSellController@index')->name('getAllSells');
    Route::get('/sells/category/{catId}', 'PostSellController@index')->name('getAllSellsByCat');
});


Route::post('/logout', 'MainController@logout_acc');
