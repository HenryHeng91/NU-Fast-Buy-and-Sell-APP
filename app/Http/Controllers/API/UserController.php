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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

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
        $user->status = 0;
        $user->save();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return PostResource
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
            $deleteResult = Post::withExpired()->where('user_id', $user->id)
                ->whereIn('id', $posts)->delete();
            if ($deleteResult > 0){
                return MakeHttpResponse(204, 'Success', "Post Id $postIds deleted.");
            }
            return MakeHttpResponse(400, 'No data', "No data found for post with id $postIds.");
        }
        return MakeHttpResponse(400, 'No data', "No data found for post with id $postIds.");
    }

    /**
     * Update a post of a user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return PostResource
     */
    public function updatePost(Request $request, $postId)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $post = Post::withExpired()->where([['user_id', $user->id], ['id', $postId]])->first();

        if (!$post){
            return MakeHttpResponse(400, 'Post not found!',
                "Post with ID $postId not found from user ID $nu_user[userId]");
        }

        $input = $request->except('NU_ECOMMERCE_USER');
        $validate = Validator::make($input, $post->getValidationArray());
        if ($validate->passes()){
            try{
                $post->update($input);
                return new PostResource($post);
            }catch (Exception $exception){
                return MakeHttpResponse(400, 'Error', $exception->getMessage());
            }
        }
        return MakeHttpResponse(400, 'Fail', $validate->errors()->all());
    }

    /**
     * Display all user's favorite posts.
     *
     * @return PostsResource
     */
    public function getFavorites(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $page = $request->input('page', 1);
        $user = User::find($nu_user['userId']);

        return new PostsResource(collect($user->favorites)->sortBy('created_at')->reverse()->forPage($page, 14));
    }

    /**
     * Assign post to user's favorite list.
     *
     * @return PostsResource
     */
    public function addFavorites(Request $request, $postId)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $page = $request->input('page', 1);
        $user = User::find($nu_user['userId']);
        if (!Post::find($postId)){
            return MakeHttpResponse(400, 'Not found', "Post with ID $postId not found.");
        }
        $user->favorites()->attach($postId);
        return new PostsResource(collect($user->favorites)->sortBy('created_at')->reverse()->forPage($page, 14));
    }

    /**
     * Delete user's favorite posts.
     *
     * @return PostsResource
     */
    public function removeFavorites(Request $request, $postIds)
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

    /**
     * Display top favorite posts.
     *
     * @return PostsResource
     */
    public function getTopFavorites()
    {
        $posts = Post::withCount('favorite_users')->orderByDesc('favorite_users_count')->orderByDesc('created_at');
        return new PostsResource($posts->take(10)->get());
    }

    /**
     * Display all user's favorite posts.
     *
     * @return PostsResource
     */
    public function getMayLike(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $frequentCategory = Post::where('user_id', $user->id)->select('category_id')->distinct()->get()->toArray();
        $categories = array_map(create_function('$o', 'return $o["category_id"];'), $frequentCategory);
        $posts = Post::withCount('favorite_users')
            ->where('user_id', '!=', $user->id)
            ->where('category_id', $categories)
            ->orderByDesc('favorite_users_count')
            ->orderByDesc('created_at');
        return new PostsResource($posts->take(10)->get());
    }

    /**
     * Display a user's expired posts.
     *
     * @return PostsResource
     */
    public function getExpired(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $posts = Post::withExpired()->where([['status', '=', 0], ['user_id', '=', $user->id]])->get();
        return new PostsResource($posts);
    }

    /**
     * Active an expired post.
     *
     * @return PostResource
     */
    public function setActive(Request $request, $postId)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $post = Post::withExpired()->where([['id', '=', $postId],['status', '=', 0], ['user_id', '=', $user->id]])->first();
        if (!$post) {
            MakeHttpResponse(400,
                'Not Found',
                "Post Id $postId not found. Either because it's not belong to user or it's not expired."
            );
        }
        $post->status = 1;
        $post->save();
        return new PostResource($post);
    }
}
