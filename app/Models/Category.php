<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class, 'category_parent', 'id');
    }
}
