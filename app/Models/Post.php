<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Post extends Model
{
    use SoftDeletes;
    protected $guarded = ['user_id', 'status', 'deleted_at', 'created_at', 'updated_at', 'id'];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function favorite_users()
    {
        return $this->belongsToMany('App\Models\User', 'favorites', 'post_id', 'user_id');
    }

    public function getValidationArray(){
        return [
            'title'         => 'required|max:255',
            'description'   => 'required',
            'price_from'    => 'required|numeric',
            'price_to'      => 'required|numeric',
            'category_id'   => 'required|integer',
            'post_type'     => ['required', Rule::in('buy','sell')],
            'contact_name'  => 'required|max:255',
            'contact_phone' => 'required|max:30',
            'contact_email' => 'required|max:190',
            'contact_address' => 'required|max:255',
        ];
    }

}
