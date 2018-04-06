<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return PostsResource
     */
    public function index()
    {
        return new PostsResource(Post::orderByDesc('created_at')->paginate());
    }

    /**
     * Display a listing of the resource by categoryId.
     *
     * @return PostsResource
     */
    public function showAllByCategory($catId)
    {
        return new PostsResource(Post::where('category_id', $catId)->orderByDesc('created_at')->paginate());
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return PostResource
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post){
            return MakeHttpResponse(400, 'No data', "No data found for post with id $id.");
        }
        return new PostResource($post);
    }

    /**
     * Display the all posts for specific user.
     *
     * @return PostsResource
     */
    public function showUserPosts(User $user)
    {
        $posts = Post::withExpired()->with('category')->where('user_id', $user->id)
                        ->orderByDesc('created_at')->paginate();
        return new PostsResource($posts);
    }

    /**
     * Display the all posts by category for specific user.
     *
     * @return PostsResource
     */
    public function showUserPostsByCategory($catId, User $user)
    {
        $posts = Post::where(['category_id' => $catId, 'user_id' => $user->id])->orderByDesc('created_at')->paginate();
        return new PostsResource($posts);
    }
}
