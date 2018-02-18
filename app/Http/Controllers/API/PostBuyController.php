<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostBuyController extends Controller
{
    private $posts;

    public function __construct()
    {
        $this->posts = Post::with('user', 'category')->where('post_type', 'buy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return PostsResource
     */
    public function index()
    {
        return new PostsResource($this->posts->paginate());
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
     * Display the specified post.
     *
     * @param  int  $id
     * @return PostResource
     */
    public function show(Request $request, $id)
    {
        $user = $request->input('NU_ECOMMERCE_USER');
        $post = $this->posts->where(['user_id' => $user['userId'], 'id' => $id])->first();
        if(!$post){
            return PostResource::error(400, 'No data', "No data found for post with id $id.");
        }
        return new PostResource($post);
    }

    /**
     * Display the all posts for specific user.
     *
     * @return PostsResource
     */
    public function showUserPosts(Request $request)
    {
        $userId = $request->input('NU_ECOMMERCE_USER');
        $posts = $this->posts->where('user_id', $userId)->paginate();
        return new PostsResource($posts);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
