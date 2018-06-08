<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct(); // TODO: Change the autogenerated stub
    }

    public function index($name , $page)
    {

        $data['categories'] = $this->guzzleGet('categories/index');
        $data['subcategories'] = $this->guzzleGet('subcategories/index');
        $data['products'] =$this->guzzleGet('products/index/'.$name."/".$page);
        $data['length'] = $this->guzzleGet('products/length/'.$name);
        $data['name'] = $name;
        $data['page'] = $page;

        return view('subcategory' , compact('data'));
    }

    public function products($name,$page)
    {
        $data['products'] = $this->guzzleGet('products/index/'.$name.'/'.$page);
        $data['page'] = $page;

        return response()->json($data);
    }


}
