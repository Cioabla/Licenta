<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class ViewProductController extends Controller
{
    public function index($name)
    {

        $client = new Client();

        $categories = $client->get('onlinestoreapi/api/v1/categories/index');
        $subcategories = $client->get('onlinestoreapi/api/v1/subcategories/index');
        $product = $client->get('onlinestoreapi/api/v1/products/product/'.$name);



        $data['categories'] = json_decode($categories->getBody(),true);
        $data['subcategories'] = json_decode($subcategories->getBody(),true);
        $data['product'] = json_decode($product->getBody(),true);


//        dd($data['product']);

        return view('product' , compact('data'));
    }
}
