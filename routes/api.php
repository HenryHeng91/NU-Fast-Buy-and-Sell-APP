<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});

Route::group(['middleware' => 'apiAuth', 'prefix' => 'users', 'namespace' => 'API'], function (){
    Route::get('/', 'UserController@index')->name('index');
});


Route::post('/logout', 'MainController@logout_acc');
