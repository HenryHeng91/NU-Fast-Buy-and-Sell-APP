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
            'profilePicture'  => $this->profile_pic,
            'role'          => Role::find($this->role)->role_name,
            'signUpDate'    => $this->created_at
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('index')
            ]
        ];
    }
}
