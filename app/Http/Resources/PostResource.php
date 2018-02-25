<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Response;

class PostResource extends Resource
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
            'description'   => $this->description,
            'price'         => array(['min'=> $this->price_from, 'max'=>$this->price_to]),
            'category'      => $this->category,
            'productImages' => explode(',', $this->product_image) ,
            'status'        => $this->status,
            'createdDate'   => $this->created_at,
            'updatedDate'   => $this->updated_at,
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
