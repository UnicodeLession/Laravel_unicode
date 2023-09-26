<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
class HomeController extends Controller
{
    public $data = [];
    function index(){
        $this->data['title'] = 'Xin Chào';
        return view('clients.home', $this->data);
    }
    function products(){
        $this->data['title'] = 'Sản Phẩm';
        return view('clients.home', $this->data);
    }
    // load form add
    function getAdd(){
        $this->data['title'] = 'Thêm Sản Phẩm';
        return view('clients.add', $this->data);
    }
    function postAdd(ProductRequest $request){
         dd($request->all());
         //
    }
}
