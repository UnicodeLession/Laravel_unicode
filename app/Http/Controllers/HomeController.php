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
            'product_name'=> ['required', 'min:6', function($attributes, $value, $fail){
                isUppercase($value, 'Trường :attribute không hợp lệ.', $fail);
            }]
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
        $validator = Validator::make($input,$rules,$messages,$attributes);
        if ($validator->fails()){
            $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu đã nhập!');
        } else {
            return redirect()->route('product')->with('msg', 'Validate Thành Công')->with('type', 'info');
        }
        return back()->withErrors($validator);
    }
}
