<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index()
    {
//        $client  = new Client([
//            'headers' => ['content-type' => 'application/json' , 'Accept' => 'application/json']
//    ]);
//        $response = $client->request('GET','OnlineStoreApi/api/v1/posts/index');

        $client = new Client(
//            [
//            // Base URI is used with relative requests
//            'base_uri' => 'OnlineStoreApi',
//            // You can set any number of default request options.
//            'timeout'  => 2.0,
//            ]
        );

        $categories = $client->get('onlinestoreapi/api/v1/categories/index');
        $subcategories = $client->get('onlinestoreapi/api/v1/subcategories/index');
        $home = $client->get('onlinestoreapi/api/v1/home/index');


        $data['categories'] = json_decode($categories->getBody(),true);
        $data['subcategories'] = json_decode($subcategories->getBody(),true);
        $data['homeproduces'] = json_decode($home->getBody(),true);

//
        return view('home' , compact('data'));
    }
}
