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

/* Get single user's information and data
 * Determine specific user using accessToken
 * Authenicate with apiAuth
 * */
Route::group(['middleware' => 'apiAuth', 'prefix' => 'user', 'namespace' => 'API'], function (){
    Route::get('/', 'UserController@show')->name('index');
    Route::post('/', 'UserController@')->name('index');
    Route::get('/buys', 'PostBuyController@showUserPosts')->name('all-buys');
    Route::get('/buy/{id}', 'PostBuyController@show')->name('single-buy');
    Route::get('/sells', 'PostSellController@showUserPosts')->name('all-sells');
    Route::get('/sell/{id}', 'PostSellController@show')->name('single-sell');
});

Route::group(['namespace' => 'API'], function (){
    Route::get('/users', 'UserController@index')->name('getAllUsers');
    Route::get('/buys', 'PostBuyController@index')->name('getAllBuys');
    Route::get('/sells', 'PostSellController@index')->name('getAllSells');
});


Route::post('/logout', 'MainController@logout_acc');
