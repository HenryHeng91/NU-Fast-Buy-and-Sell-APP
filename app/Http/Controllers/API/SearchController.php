<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostsResource;
use App\Http\Resources\SearchResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display a listing of the search posts.
     *
     * @return PostsResource
     */
    public function index(Request $request)
    {
        $string = $request->query('s');
        $posts = Post::withCount('favorite_users')
            ->where('title', 'like', "%$string%")
            ->orWhere('description', 'like', "%$string%")
            ->orderByDesc('favorite_users_count')
            ->orderByDesc('created_at');
        return new PostsResource($posts->paginate(14));
    }
    
    /**
     * Display a listing of the search buy posts.
     *
     * @return PostsResource
     */
    public function searchBuy(Request $request)
    {
        $string = $request->query('s');
        $posts = Post::withCount('favorite_users')
            ->where('post_type', 'buy')
            ->where(function ($query) use ($string){
                $query->where('title', 'like', "%$string%")
                    ->orWhere('description', 'like', "%$string%");
            })
            ->orderByDesc('favorite_users_count')
            ->orderByDesc('created_at');
        return new PostsResource($posts->paginate());
    }

    /**
     * Display a listing of the search sell posts.
     *
     * @return PostsResource
     */
    public function searchSell(Request $request)
    {
        $string = $request->query('s');
        $posts = Post::withCount('favorite_users')
            ->where('post_type', 'sell')
            ->where(function ($query) use ($string){
                $query->where('title', 'like', "%$string%")
                    ->orWhere('description', 'like', "%$string%");
            })
            ->orderByDesc('favorite_users_count')
            ->orderByDesc('created_at');
        return new PostsResource($posts->paginate());
    }
}
