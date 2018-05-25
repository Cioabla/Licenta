<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function insert(Request $request)
    {
//            return response()->json($request->email);

        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $user = $client->post('onlinestoreapi/api/v1/users/add',
            ['body' => json_encode(
                    $request->all()
            )]
        );



        $user = json_decode($user->getBody(),true);

        session($user);

        $result = Session::get('name');


        dd($result);//
    }
}
