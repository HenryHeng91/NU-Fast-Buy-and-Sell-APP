<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Response;

class SearchResource extends Resource
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
            'type'          => $this->post_type,
            'id'            => $this->id,
            'title'         => $this->title,
            'price'         => array(['min'=> $this->price_from, 'max'=>$this->price_to]),
            'category'      => $this->category,
            'favoriteCount'  => $this->favorite_users()->count(),
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
