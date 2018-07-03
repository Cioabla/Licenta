<?php

namespace App\Http\Controllers;


class ViewProductController extends Controller
{
    public function index($name)
    {

        $data['categories'] = $this->guzzleGet('categories/index');
        $data['subcategories'] = $this->guzzleGet('subcategories/index');
        $data['product'] = $this->guzzleGet('products/product/'.$name);

        return view('product' , compact('data'));
    }
}
