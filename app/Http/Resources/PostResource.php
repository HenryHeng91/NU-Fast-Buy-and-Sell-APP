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
            'productImages' => trim($this->product_image) ? $this->mapImagePath(explode(';', trim($this->product_image))) : [] ,
            'contactName'   => $this->contact_name,
            'contactPhone'  => $this->contact_phone,
            'contactEmail'  => $this->contact_email,
            'contactAddress'=> $this->contact_address,
            'contactMapCoordinate'  => $this->contact_address_map_coordinate,
            'favoriteCount' => $this->favorite_users()->count(),
            'contactMe'     => new UsersResource($this->contactmeUsers),
            'status'        => $this->status ? 'active' : 'expired',
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

    private function mapImagePath($arr){
        return array_map(function($i){return asset(env('IMAGE_PATH')).'/'.$i;}, $arr);
    }

}
