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
    public function uploadPostImage(Request $request){
        $nu_user = $request->input('NU_ECOMMERCE_USER');
        $user = User::find($nu_user['userId']);
        
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
        return MakeHttpResponse(200, 'Success', implode(';', $imageFileNames));
    }

    /**Delete images
     *
     * @param Request $request
     * @return PostResource
     */
    public function deletePostImage(Request $request, $imageName){
        $destinationPath = public_path('images/posts/');

        $images = explode(',', trim($imageName));
        foreach ($images as $image){
            if (File::exists($destinationPath.'/'.$image)){
                try{
                    File::delete($destinationPath.'/'.$image);
                }catch (Exception $e){
                    return MakeHttpResponse(400, 'Fail', $e->getMessage());
                }
            }
        }
        return MakeHttpResponse(204, 'Success', "Successfully delete image '$imageName'.");
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
