<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id','accountkit_id', 'email', 'phone', 'access_token', 'role', 'remember_token'];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
