<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
