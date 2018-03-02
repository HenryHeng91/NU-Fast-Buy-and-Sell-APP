<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => SearchResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'timestamp' => now()->toDateTimeString(),
            ]
        ];
    }
}
