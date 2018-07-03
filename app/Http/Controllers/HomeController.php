<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {

        $data['categories'] = $this->guzzleGet('categories/index');
        $data['subcategories'] = $this->guzzleGet('subcategories/index');
        $data['homeproduces'] = $this->guzzleGet('home/index');

        $data = json_decode(json_encode($data));


        return view('home' , compact('data'));
    }
}
