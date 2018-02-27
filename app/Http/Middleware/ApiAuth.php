<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Response;


class ApiAuth
{
    protected $appId;
    protected $appSecret;
    protected $tokenExchangeUrl;
    protected $endPointUrl;
    public $userAccessToken;
    protected $refreshInterval;


    public function __construct()
    {
        $this->appId            = config('accountkit.app_id');
        $this->client           = new GuzzleHttpClient();
        $this->appSecret        = config('accountkit.app_secret');
        $this->endPointUrl      = config('accountkit.end_point');
        $this->tokenExchangeUrl = config('accountkit.tokenExchangeUrl');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            if (!config('accountkit.allowUserAccessToken')){
                $auth_code = $request->header('auth-code');
                if (!$auth_code) {
                    return Response::json(['error'=>'Missing Authorization Code!'], 401);
                }
                $this->login($auth_code);
            } else {
                $access_token = $request->header('access-token');
                if (!$access_token){
                    return Response::json(['error'=>'Missing Access Token!'], 401);
                }
                $this->userAccessToken = $access_token;
            }

            $userData = $this->getData();
            $user = User::where('accountkit_id', $userData['userId'])->with(['posts', 'posts.category', 'posts.category.parentCategory'])->first();
            if ($user == null){
                $newUser = new User();
                $newUser->accountkit_id = $userData['userId'];
                $newUser->first_name = '';
                $newUser->last_name = '';
                $newUser->email = $userData['email'];
                $newUser->phone = $userData['phone'];
                $newUser->gender = 'male';
                $newUser->access_token = $userData['userAccessToken'];
                $newUser->status = 1;
                $newUser->save();
                $user = $newUser;
                $request->merge(['NU_ECOMMERCE_USER' => ['userId' => $user->id, 'status' => 'new' ]]);
            } else {
                $user->access_token = $userData['userAccessToken'];
                $user->save();
                $request->merge(['NU_ECOMMERCE_USER' => ['userId' => $user->id, 'status' => 'old' ]]);
            }

            return $next($request);

        } catch (\Exception $e){
            return Response::json(['error'=>'Unauthenticated', 'debug'=>$e->getMessage()], 401);
        }
    }

    public function login($authCode){
        $url = $this->tokenExchangeUrl.'grant_type=authorization_code'.
            '&code='. $authCode.
            "&access_token=AA|$this->appId|$this->appSecret";

        $apiRequest = $this->client->request('GET', $url);

        $body = json_decode($apiRequest->getBody());

        $this->userAccessToken = $body->access_token;

        $this->refreshInterval = $body->token_refresh_interval_sec;
    }

    public function getData()
    {
        $request = $this->client->request('GET', $this->endPointUrl.$this->userAccessToken);
        $data = \GuzzleHttp\json_decode($request->getBody());
        $userId = $data->id;
        $userAccessToken = $this->userAccessToken;
        $refreshInterval = $this->refreshInterval;
        $phone = isset($data->phone) ? $data->phone->number : '';
        $email = isset($data->email) ? $data->email->address : '';
        return compact('phone', 'email', 'userId', 'userAccessToken', 'refreshInterval');
    }


}
