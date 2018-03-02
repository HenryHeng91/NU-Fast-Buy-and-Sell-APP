<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SearchesResource;
use App\Http\Resources\SearchResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display a listing of the search posts.
     *
     * @return SearchesResource
     */
    public function index(Request $request)
    {
        $string = $request->query('s');
        $posts = Post::withCount('favorite_users')
            ->where('title', 'like', "%$string%")
            ->orWhere('description', 'like', "%$string%")
            ->orderByDesc('favorite_users_count')
            ->orderByDesc('created_at');
        return new SearchesResource($posts->paginate(14));
    }
}
