<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Response;

class BannerResource extends Resource
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
            'id'            => $this->id,
            'title'         => $this->title,
            'content'   => $this->content,
            'status'        => $this->status ? 'active' : 'inactive',
            'bannerImage'=> asset(env('BANNER_PATH')).'/'.$this->banner_image,
            'createdDate'   => $this->created_at,
            'updatedDate'   => $this->updated_at,
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'timestamp' => now()->toDateTimeString(),
                'link' => route('banner.get'),
            ]
        ];
    }
}
