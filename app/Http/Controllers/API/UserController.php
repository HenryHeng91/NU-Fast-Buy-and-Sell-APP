<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UsersResource
     */
    public function index()
    {
        $users = User::withCount([
            'posts as totalPostsBuy' => function($posts){
                $posts->where('post_type', 'buy');
            },
            'posts as totalPostsSell' => function($posts){
                $posts->where('post_type', 'sell');
            }
        ])->paginate();
        return new UsersResource($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function createPost(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $input = $request->except('NU_ECOMMERCE_USER');
        $post = new Post($input);
        $validate = Validator::make($input, $post->getValidationArray());
        if ($validate->passes()){
            $newpost = $user->posts()->save($post);
            return new PostResource($newpost);
        } else {
            return MakeHttpResponse(400, 'Fail', $validate->errors()->all());
        }
    }

    /**
     * Delete a post of a user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deletePost(Request $request, $postIds)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $posts = trim($postIds) ? explode(',', trim($postIds)) : [];
        if (count($posts) > 0){
            $postsToBeDeleted = $user->posts->whereIn('id', $posts);
            if (count($postsToBeDeleted) > 0){
                Post::destroy($posts);
                return MakeHttpResponse(204, 'Success', "Post Id $postIds deleted.");
            }
            return MakeHttpResponse(400, 'No data', "No data found for post with id $postIds.");
        }
        return MakeHttpResponse(400, 'No data', "No data found for post with id $postIds.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::withCount([
            'posts as totalPostsBuy' => function($posts){
                $posts->where('post_type', 'buy');
            },
            'posts as totalPostsSell' => function($posts){
                $posts->where('post_type', 'sell');
            }
        ])->find($nu_user['userId']);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);

        $user->update($request->except('NU_ECOMMERCE_USER'));
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);

        if ($user->delete()){
          return MakeHttpResponse(204,'Success', "Success delete user with id $nu_user[userId]");
        }

        return MakeHttpResponse(400,'Failed delete', "Failed to delete user with id $nu_user[userId]");
    }

    /**
     * Display all user's favorite posts.
     *
     * @return PostsResource
     */
    public function getFavtorites(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $page = $request->input('page', 1);
        $user = User::find($nu_user['userId']);

        return new PostsResource(collect($user->favorites)->sortBy('created_at')->reverse()->forPage($page, 15));
    }

    /**
     * Delete user's favorite posts.
     *
     * @return PostsResource
     */
    public function removeFavtorites(Request $request, $postIds)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $postsToRemove = explode(',', $postIds);
        if (Count($postsToRemove) > 0){
            if ($user->favorites()->detach($postsToRemove)){
                return MakeHttpResponse(204, 'Success', 'Successfully delete favorite post with Id'.$postIds);
            }
        }
        return MakeHttpResponse(400, 'Error', 'Error deleting favorite posts');
    }
}
