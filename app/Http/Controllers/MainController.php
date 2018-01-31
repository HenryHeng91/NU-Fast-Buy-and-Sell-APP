<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class MainController extends Controller
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

    public function login(Request $request){
        $url = $this->tokenExchangeUrl.'grant_type=authorization_code'.
            '&code='. $request->get('code').
            "&access_token=AA|$this->appId|$this->appSecret";

        $apiRequest = $this->client->request('GET', $url);

        $body = json_decode($apiRequest->getBody());

        $this->userAccessToken = $body->access_token;

        $this->refreshInterval = $body->token_refresh_interval_sec;

        return $this->getData();
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
        return view('index', compact('phone', 'email', 'userId', 'userAccessToken', 'refreshInterval'));

    }

    public function logout()
    {
        return redirect()->route('index');
    }

    public function index()
    {
        return view('welcome');
    }

    public function test($accessToken, $intervalSec)
    {

        $this->userAccessToken = $accessToken;
        $this->refreshInterval = $intervalSec;
        return $this->getData();

    }


}
