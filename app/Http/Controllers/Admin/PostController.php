<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    function index(){
        return 'Danh Sách Bài Viết';
    }
    function add(){
        return "Thêm Bài Viết";
    }
    function edit($id){
        return 'Sửa bài viết có id='.$id;
    }
}
