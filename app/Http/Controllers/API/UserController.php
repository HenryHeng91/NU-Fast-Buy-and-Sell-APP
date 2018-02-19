<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UsersResource
     */
    public function index()
    {
        $users = User::withCount([
            'posts as totalPostsBuy' => function($posts){
                $posts->where('post_type', 'buy');
            },
            'posts as totalPostsSell' => function($posts){
                $posts->where('post_type', 'sell');
            }
        ])->paginate();
        return new UsersResource($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::withCount([
            'posts as totalPostsBuy' => function($posts){
                $posts->where('post_type', 'buy');
            },
            'posts as totalPostsSell' => function($posts){
                $posts->where('post_type', 'sell');
            }
        ])->find($nu_user['userId']);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(Request $request)
    {
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);

        $user->update($request->except('NU_ECOMMERCE_USER'));
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
