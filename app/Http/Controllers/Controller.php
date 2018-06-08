<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//use Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;
use \Firebase\JWT\JWT;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $api_url;
    private $guzzle;
    private $header = null;
    private $body = null;
    private $jwt_key;


    public function __construct()
    {
        $this->api_url=env('API_URL');
        $this->setJwtSecret(env('JWT_secret'));
        $this->guzzle = new Client();
        $this->jwt_key=env('JWT_key');
    }

    public function decode($guzzleResponse)
    {
        return json_decode($guzzleResponse->getBody(),true);

    }

    public function error($statusCode)
    {
        return view('error/error'.$statusCode);
    }

        public function guzzlePost($form_params , $path)
    {
        $this->setGuzzleBody($form_params);
        $result = $this->sendGuzzleRequest($this->createGuzzleRequest('POST',$this->api_url . '/' . $path));

        if($result->getStatusCode() != 200)
        {
            $this->error($result->getStatusCode());
        }else {
            return $this->decode($result);
        }

    }

    public function guzzleGet($path)
    {
        $result = $this->sendGuzzleRequest($this->createGuzzleRequest('GET',$this->api_url . '/' . $path));

        if($result->getStatusCode() != 200)
        {
            $this->error($result->getStatusCode());
        }else {
            return $this->decode($result);
        }
    }

    public function createGuzzleRequest($method , $path)
    {

        if($this->body != null)
        {
//            dd($request = new Request($method,$path,
//                [
//                    'headers' =>$this->header,
//                    'body' => $this->body
//                ]
//            ));

           return $request = new Request($method,$path,
                $this->header , json_encode($this->body)
            );



        }else{
            return $request = new Request($method,$path,
                $this->header
            );
        }
    }

    public function sendGuzzleRequest($request)
    {
        return $this->guzzle->send($request);
    }

    public function setGuzzleHeader($name , $params)
    {
        if($this->header == null)
        {
            return $this->header = ['Content-Type' => 'application/json',
                $name => $params
            ];
        }else{
            return $this->header = array_merge_recursive($this->header, [$name => $params]);
        }
    }

    public function setGuzzleBody($request)
    {
        return $this->body = $request;
    }

    public function checkLogin()
    {
//        dd(Session::has('name'));
        if(Session::has('name') == true)
        {
            return true;
        }else{
            return false;
        }
    }

    public function setJwtSecret($jwt)
    {
        $this->setGuzzleHeader('JWT' , $jwt);
    }

    public function jwtDecode($jwt)
    {
        return JWT::decode($jwt, $this->jwt_key, array('HS256'));
    }

    public function createSession($data)
    {
//        Session::put('id',$data->id);
//        Session::put('name',$data->name);
        session([
            'id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password
        ]);
    }

    public function sessionClear()
    {
        Session::flush();

    }
}
