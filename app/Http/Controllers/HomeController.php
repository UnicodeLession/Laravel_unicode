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
    // load form add
    function getAdd(){
        $this->data['title'] = 'Thêm Sản Phẩm';
        return view('clients.add', $this->data);
    }
    function postAdd(Request $request){
         $request->validate(
             // https://laravel.com/docs/10.x/validation#available-validation-rules
             [
                 'product_price'=> 'required|integer',
                 'product_name'=> 'required|min:6'
             ],
             [
                 'product_name.required'=>'Vui lòng nhập tên sản phẩm',
                 'product_name.min'=>'Tên sản phẩm không được bé hơn :min kí tự', // sẽ lấy giá trị min bên trên xuống
                 'product_price.required'=>'Vui lòng nhập giá sản phẩm',
                 'product_price.interger'=>'Giá sản phẩm phải là giá trị số',
             ]
         );
         //
    }
}
