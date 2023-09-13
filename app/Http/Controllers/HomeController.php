<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        return "<h1 style='text-align: center'>Trang Chủ</h1>";
    }
    function getNews(){
        return "<h1 style='text-align: center'>Danh Sách Tin Tức</h1>";
    }
    function getProducts(){
        return "<h1 style='text-align: center'>Danh Sách Sản Phẩm</h1>";
    }
}
