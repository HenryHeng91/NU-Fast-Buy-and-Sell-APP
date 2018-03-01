<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ImageUploadController extends Controller
{

    /**Upload user profile pic and set profile pic for specific user
     *
     * @param Request $request
     * @return UserResource|\Illuminate\Support\Facades\Response
     */
    public function uploadProfileImage(Request $request){
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);

        if (!$request->has('image_file')){
            return MakeHttpResponse(400, 'Fail', "No input name 'image_file' found!");
        }

        $fileInput = $request->file('image_file');
        $destinationPath = public_path('images/avatars/');
        $defaultAvatar = 'avatar.png';

        $validator = Validator::make(array('image_file'=>$fileInput), ['image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240']);
        if ($validator->fails()){
            return MakeHttpResponse(400, 'Fail', $validator->errors()->all());
        }
        try{
            if ($user->profile_pic && $user->profile_pic != $defaultAvatar){
              File::delete($destinationPath.$user->profile_pic);
            }

            $user->profile_pic = $this->saveImageToPath($fileInput, $destinationPath, 'avatar-');
            $user->save();
        }catch (Exception $exception){
            return MakeHttpResponse(400, 'Fail', $exception->getMessage());
        }
        return new UserResource($user);
    }

    /**Upload post images and return array of file name
     *
     * @param Request $request
     * @return PostResource
     */
    public function uploadPostImage(Request $request, $postId){
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        $post = $user->posts()->where('id', $postId);
        
        if ($post == null){
            return MakeHttpResponse(400, 'Post not found', "PostId $postId not found or belong to userId $nu_user[userId]");
        }

        if (!$request->has('image_file')){
            return MakeHttpResponse(400, 'Fail', "No input name 'image_file' found!");
        }

        $fileInput = $request->file('image_file');
        $destinationPath = public_path('images/posts/');
        $fileInput = !is_array($fileInput) ? (array) $fileInput : $fileInput;

        $imageFileNames = [];
        foreach ($fileInput as $item){
            $validator = Validator::make(array('image_file'=>$item), ['image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240']);
            if ($validator->fails()){
                return MakeHttpResponse(400, 'Fail', $validator->errors()->all());
            }
            try{
                $fileName = $this->saveImageToPath($item, $destinationPath, 'post-');
                array_push($imageFileNames, $fileName);
            }catch (Exception $exception){
                return MakeHttpResponse(400, 'Fail', $exception->getMessage());
            }
        }
        $post->product_image = $post->product_image.implode(';', $imageFileNames);
        $post->save();
        return new PostResource($post);
    }


    /**Save an image to specific path
     *
     * @param $imageFile = Image file to be saved
     * @param $destinationPath = Destination path to be saved
     * @param string $imagePrefix = Prefix name of the image
     * @return string
     */
    private function saveImageToPath($imageFile, $destinationPath, $imagePrefix = ''){
        $filename = $imagePrefix.uniqid().'.'.$imageFile->getClientOriginalExtension();
        $imageFile->move($destinationPath, $filename);
        return $filename;
    }
}
