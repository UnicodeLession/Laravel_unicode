<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data = [];
    function index(){
        $this->data['welcome'] = 'Xin Chào';
        return view('home', $this->data);
    }
}
