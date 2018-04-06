<?php

use App\Http\Resources\BannersResource;
use App\Models\Banner;
use App\Models\Post;
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

    Route::get('/post/expire', 'UserController@getExpired')->name('expired-post');
    Route::get('/post/active/{postId}', 'UserController@setActive')->name('active-post');
    Route::get('/post/maylike', 'UserController@getMayLike')->name('may-like');

    Route::get('/buys', 'PostBuyController@showUserPosts')->name('all-buys');
    Route::get('/buys/category/{catId}', 'PostBuyController@showUserPostsByCategory')->name('all-buys-by-cat');
    Route::get('/buy/{id}', 'PostBuyController@show')->name('single-buy');
    Route::put('/buy/{id}', 'PostBuyController@update')->name('update-buy');

    Route::get('/sells', 'PostSellController@showUserPosts')->name('all-sells');
    Route::get('/sells/category/{catId}', 'PostSellController@showUserPostsByCategory')->name('all-sells-by-cat');
    Route::get('/sell/{id}', 'PostSellController@show')->name('single-sell');

    //===== USER'S FAVORITE POSTS =====
    Route::get('/favorites', 'UserController@getFavorites')->name('favorites');
    Route::get('/favorites/top', 'UserController@getTopFavorites')->name('favorites');
    Route::get('/favorites/{postId}', 'UserController@addFavorites')->name('add-favorites');
    Route::delete('/favorites/{postIds}', 'UserController@removeFavorites')->name('delete-favorites');



});

//===== ALL USERS =====
Route::group([ 'prefix' => 'users', 'namespace' => 'API', 'name' => 'user.'], function (){
    Route::get('/', 'UserController@index')->name('getAllUsers');
});

//===== ALL BUY POSTS =====
Route::group([ 'prefix' => 'buys', 'namespace' => 'API', 'name' => 'buys.'], function (){
    Route::get('/', 'PostBuyController@index')->name('getAllBuys');
    Route::get('/category/{catId}', 'PostBuyController@showAllByCategory')->name('getAllBuysByCat');
    Route::get('/topview', 'PostBuyController@showTopView')->name('getTopView');
});

//===== ALL SELL POSTS =====
Route::group([ 'prefix' => 'sells', 'namespace' => 'API', 'name' => 'sells.'], function (){
    Route::get('/', 'PostSellController@index')->name('getAllSells');
    Route::get('/category/{catId}', 'PostSellController@showAllByCategory')->name('getAllSellsByCat');
    Route::get('/topview', 'PostSellController@showTopView')->name('getTopView');
});

//===== ALL CATEGORIES =====
Route::group(['prefix' => 'categoies', 'namespace' => 'API', 'name' => 'categoies.'], function (){
    Route::get('/', 'CategoryController@getAllCategories')->name('all');
    Route::get('/parents', 'CategoryController@getParentCategories')->name('parents');
});

//===== IMAGES =====
Route::group([ 'middleware' => 'apiAuth', 'prefix' => 'images', 'namespace' => 'API', 'name' => 'images.'], function (){
    Route::post('/profile', 'ImageUploadController@uploadProfileImage')->name('profile');
    Route::post('/post', 'ImageUploadController@uploadPostImage')->name('post');
    Route::delete('/post/{imageName}', 'ImageUploadController@deletePostImage')->name('delete-post-image');
});

//===== SEARCH =====
Route::group([ 'prefix' => 'search', 'namespace' => 'API', 'name' => 'search.'], function (){
    Route::get('/', 'SearchController@index')->name('searchAll');
    Route::get('/buy', 'SearchController@searchBuy')->name('searchBuy');
    Route::get('/sell', 'SearchController@searchSell')->name('searchSell');
});

//===== CONTACT ME =====
Route::group([ 'middleware' => 'apiAuth', 'prefix' => 'contactme', 'namespace' => 'API', 'name' => 'contactme.'], function (){
    Route::get('/{postId}', 'UserController@contactMe')->name('add');
    Route::delete('/{postId}', 'UserController@removeContactMe')->name('remove');
});

//===== POST VIEW =====
Route::group([ 'middleware' => 'apiAuth', 'prefix' => 'view', 'namespace' => 'API', 'name' => 'view.'], function (){
    Route::get('/{postId}', 'UserController@addView')->name('add');
});

//===== BANNER =====
Route::group([ 'prefix' => 'banner', 'namespace' => 'API', 'name' => 'banner.'], function (){
    Route::get('/', function (){
        $banners = Banner::where('status', 1)->orderByDesc('created_at')->get();
        return new BannersResource($banners);
    })->name('get');
});

//===== TEST LINK =====
Route::group([ 'middleware' => 'apiAuth', 'prefix' => 'test', 'namespace' => 'API', 'name' => 'test.'], function (){
    Route::get('/sendnotification/{userId}', function ($userId, Request $request){
        $nu_user = $request->input('NU_ECOMMERCE_USER')['userId'];
        $requestUser = User::find($nu_user);
        if ($requestUser == null || $requestUser->role != 4){
            return MakeHttpResponse(401, 'Unauthorized', 'Only admin user can access');
        }
        OneSignal::sendNotificationUsingTags("Testing notification to user id $userId", array(
            ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $userId]
        ), $url = null, $data = null, $buttons = null, $schedule = null);
        return MakeHttpResponse(200, 'Success', 'Adding notification successfully.');
    });

    Route::get('/makepostexpire/{postId}', function ($postId, Request $request){
        $nu_user = $request->input('NU_ECOMMERCE_USER')['userId'];
        $requestUser = User::find($nu_user);
        if ($requestUser == null || $requestUser->role != 4){
            return MakeHttpResponse(401, 'Unauthorized', 'Only admin user can access');
        }
        $post = Post::find($postId);
        if ($post == null) {
            return MakeHttpResponse(400, 'No post found', "Post with id '$postId' not found in database!");
        }
        $post->status = 0;
        $post->save();
        return MakeHttpResponse(200, 'Success', "Set Post id '$postId' to expired.");
    });


});


Route::post('/logout', 'MainController@logout_acc');
