<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Rules\Uppercase;

use Illuminate\Support\Facades\Validator;
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
        $input = $request->all();
        $rules = [
            'product_price'=> 'required|integer',
            'product_name'=> ['required', 'min:6', new Uppercase()]
        ];
        $messages = [
             'required'=>'Vui lòng nhập :attribute',
             'min'=>':attribute không được bé hơn :min kí tự', // sẽ lấy giá trị min bên trên xuống
             'interger'=>':attribute phải là giá trị số',
         ];
        $attributes = [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm'
        ];
        $validation=Validator::make($input, $rules, $messages,$attributes);
//        $validation->validate(); // load lâu hơn thì phải?
        if ($validation->fails()){ // không có sự chuyển hướng trang
            $validation->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu đã nhập!');
//            return 'Validate Thất Bại';
        }
        return back()->withErrors($validation);
        /**
         * ?  $input: là mảng dữ liệu chứa các dữ liệu cần validation ( thường truyền $request->all() )
         * ?  $attributes: là mảng chứa các tên trường (có thể bỏ trống)
        */
    }
}
