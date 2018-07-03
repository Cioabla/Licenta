<?php

namespace App\Http\Controllers;



class CategoryController extends Controller
{
    public function index($name , $page)
    {

        $data['categories'] = $this->guzzleGet('categories/index');
        $data['subcategories'] = $this->guzzleGet('subcategories/index');
        $data['products'] =$this->guzzleGet('products/index/'.$name."/".$page);
        $data['length'] = $this->guzzleGet('products/length/'.$name);
        $data['name'] = $name;
        $data['page'] = $page;

        $data = json_decode(json_encode($data));

        return view('subcategory' , compact('data'));
    }

    public function products($name,$page)
    {
        $data['products'] = $this->guzzleGet('products/index/'.$name.'/'.$page);
        $data['page'] = $page;

        return response()->json($data);
    }


}
