<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CategoryController extends Controller
{
    public function index($name , $page)
    {

        $client = new Client();

        $categories = $client->get('onlinestoreapi/api/v1/categories/index');
        $subcategories = $client->get('onlinestoreapi/api/v1/subcategories/index');
        $products = $client->get('onlinestoreapi/api/v1/products/index/'.$name.'/'.$page);
        $length = $client->get('onlinestoreapi/api/v1/products/length/'.$name);



        $data['categories'] = json_decode($categories->getBody(),true);
        $data['subcategories'] = json_decode($subcategories->getBody(),true);
        $data['products'] = json_decode($products->getBody(),true);
        $data['length'] = json_decode($length->getBody(),true);
        $data['name'] = $name;
        $data['page'] = $page;

//        dd($data['products']);

        return view('subcategory' , compact('data'));
    }

    public function products($name,$page)
    {
        $client = new Client();

        $products = $client->get('onlinestoreapi/api/v1/products/index/'.$name.'/'.$page);
        $data['products'] = json_decode($products->getBody(),true);
        $data['page'] = $page;

        return response()->json($data);
    }


}
