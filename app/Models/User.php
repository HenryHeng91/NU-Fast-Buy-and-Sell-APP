<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id','accountkit_id', 'email', 'phone', 'access_token', 'role', 'remember_token'];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Models\Post', 'favorites', 'user_id', 'post_id');
    }

    public function contactme()
    {
        return $this->belongsToMany('App\Models\Post', 'contact_mes', 'user_id', 'post_id');
    }
}
