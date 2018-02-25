<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'type'          => 'users',
            'id'            => $this->id,
            'firstName'     => $this->first_name,
            'lastName'      => $this->last_name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'gender'        => $this->gender,
            'address'       => $this->address,
            'city'          => $this->city,
            'profilePicture'  => asset(env('AVATAR_PATH')).'/'.$this->profile_pic,
            'role'          => Role::find($this->role)->role_name,
            'status'          => $this->status ? 'new' : 'old',
            'totalPostsBuy'    => $this->totalPostsBuy,
            'totalPostsSell'    => $this->totalPostsSell,
            'signUpDate'    => $this->created_at
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
