<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'categoryName'      => $this->category_name,
            'categoryNameKhmer' => $this->category_name_khmer,
            'categoryImage'     => trim($this->category_image) ? asset(env('CATEGORY_PATH')).'/'.$this->category_image : "",
            'categoryParent'    => $this->when($this->parentCategory, new CategoryResource($this->parentCategory)),
            'categoryChildren'  => $this->when($this->categoryChildren, $this->categoryChildren),
            'productCount'      => $this->when($this->parentCategory, $this->posts_count)
        ];

    }

    public function with($request)
    {
        return [
            'meta' => [
                'timestamp' => now()->toDateTimeString(),
                'link' => route('index'),
            ]
        ];
    }
}
