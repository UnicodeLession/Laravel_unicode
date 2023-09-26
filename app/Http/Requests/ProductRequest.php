<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    // phương thức này sẽ cho phép người dùng thực thi request này hay không
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    // phương thức sẽ chứa các rules cần validate
    {
        return [
            'product_price'=> 'required|integer',
            'product_name'=> 'required|min:6'
        ];
    }

    function messages()
    {
        return [
            'product_name.required'=>'Vui Lòng Nhập :attribute',
            'product_name.min'=>':attribute Không Được Bé Hơn :min Kí Tự', // sẽ lấy giá trị min bên trên xuống
            'product_price.required'=>'Vui Lòng Nhập :attribute',
            'product_price.interger'=>':attribute Phải Là Giá Trị Số',
        ];
    }
    function attributes()
    {
        return [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm'
        ];
    }
    // laravel 8
    /*
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }
    */
    // laravel 10
    protected function after(): array
    {
        return [
            function (Validator $validator) {
//                dd($validator->errors()->count()); // đếm số lượng lỗi
                if ($validator->errors()->count()) {
                    $validator->errors()->add(
                        'msg',
                        'Something is wrong with this field!'
                    );
                }
            }
        ];
    }
    protected function prepareForValidation(): void // trước khi validation
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'), // thêm giá trị có cùng với _token, product_name vào product_price

        ]);
    }
    // khi chuyển authorize() return false thì sẽ set up thông báo
    public function failedAuthorization()
    {
//        throw new AuthorizationException('Bạn không có quyền truy cập!');
//        throw new HttpResponseException(redirect('/')
//            ->with('msg', 'Bạn vừa ấn nút submit nhưng không có quyền truy cập')
//            ->with('type', 'danger')
//        ); // khi submit thì sẽ chuyển đến home
        throw new HttpResponseException(abort(404)); // sẽ render 404.blade.php
    }
}
