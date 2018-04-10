<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of all cateogires.
     *
     * @return CategoriesResource
     */
    public function getAllCategories()
    {
        $categories = Category::withCount('posts')->whereNotNull('category_parent')->get();
        return new CategoriesResource($categories);
    }

    /**
     * Display a listing of the top level categories.
     *
     * @return CategoriesResource
     */
    public function getParentCategories()
    {
        $categories = Category::whereNull('category_parent')->get();
        foreach ($categories as $category){
            $categoryChildren = Category::select(['id', 'category_name', 'category_name_khmer', 'category_image'])
                ->where('category_parent', $category->id)->get();
                $category->categoryChildren = $categoryChildren;
        }
        return new CategoriesResource($categories);

    }
}
