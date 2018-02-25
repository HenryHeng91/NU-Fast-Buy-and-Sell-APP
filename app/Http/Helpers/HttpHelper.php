<?php
/**
 * Created by PhpStorm.
 * User: Henry Heng
 * Date: 25-Feb-18
 * Time: 3:36 PM
 */

use Illuminate\Support\Facades\Response;


/**
 * Handle HTTP error
 *
 * @param $code
 * @param $title
 * @param string $description
 * @return Response
 */
function MakeHttpResponse($code, $title, $description = ''){
    return Response::json([
        'error'=>$code,
        'title'=>$title,
        'description'=>$description,
    ], $code);
}

