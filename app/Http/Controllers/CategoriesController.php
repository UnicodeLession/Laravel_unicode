<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // xử dụng HTTP request

class CategoriesController extends Controller
{
    public function __construct(Request $request)
    {
        if ($request->is('categories')){
            echo 'Show Catagories';
            echo "<hr />";
            /**
             * khi đó http://localhost:8000/categories thì sẽ show 'Show Catagories'
             * nhưng http://localhost:8000/categories/add hay bất kì đâu trừ cái trên thì sẽ k hiện 'Show Catagories'
            */
        }
        if($request->is('categories/*')){
            echo 'Đây là chấp nhận tất cả các path có /categories/ ở đằng trước ví dụ /categories/add';
            echo "<hr />";
        };
    }

    // Hiển thị Danh sách chuyên mục (GET)
    function index(Request $request) {
        dd($request);
        /**
         * http://localhost:8000/categories?id=1
         * khi đó vào query -> #parameters sau đó sẽ tồn tại array ['id' = 1]
         *
         * $request->query->get('id') = 1
        */
       return view('clients/categories/lists');
    }
    // show các props func của Request
    function showRequest(Request $request)
    {
        /**
         * $allData = ['id' = 1]
        */
        $allData = $request->all(); // lấy ra tất cả dữ liệu tương đương $_GET
        $path = $request->path(); // lấy ra path ~ $_SERVER['REQUEST_METHOD']
        $url = $request->url(); // lấy ra url nhưng k bao gồm cả tham số trên url : https://i.imgur.com/7fy0ouX.png
        $fullUrl = $request->fullUrl(); // như cái trên nhưng bao gồm cả tham số trên url: https://i.imgur.com/F4F1vaN.png
        $method = $request->method(); // lấy ra HTTP request của url
        $ip = $request->ip(); // lấy ra ip của máy đã gửi HTTP request
        $server = $request->server(); // bản rút gọn của $_SERVER , biến $server là array
        $input = $request->input('name.person1'); // lấy tham số trên url với GET | lấy value trong input của POST
        $name = $request->name['person1'];
        $name = request('name.person1', 'Nguyễn Văn A'); // tương đương biến $name bên trên
        $name = $request->query('name')['person1'];
        // với query thì không dùng được kiểu name.person1 và chỉ dùng với url chứ POST không được
        /**
         * http://localhost:8000/request?name[person1]=Nguy%E1%BB%85n%20Minh%20Hi%E1%BA%BFu&name[person2]=Chat%20gpt
         * với $input = 'Nguyễn Minh Hiếu' => name.person1 = name['person1']
         *
         * http://localhost:8000/request?name[person1]=
         * với url trên thì nếu request('name.person1') = null thì sẽ chọn lấy default value biến thứ 2 của request()
         *
        */
        $helperFunc = request();
        // helper function ~ global function ~ không cần dùng use
        // (https://laravel.com/docs/10.x/requests#retrieving-input-from-the-query-string)
        $existCheck = $request->has('category_name');//~ isset() | kiểm tra xem có TỒN TẠI $request->category_name hay không, mặc kệ biến tồn tại value hay không
        dd($name);

    }
//    CRUD : Create, Read, Update, Delete
    // show form thêm data (GET)
    function addCategory(Request $request)
    {
        $cateName = $request->old('category_name');

        return view('clients/categories/add', compact('cateName'));
    }
    // Tạo thêm 1 chuyên mục (POST)
    function handleAddCategory(Request $request)
    {
        // truy cập vào http://localhost:8000/categories/add
        $allData = $request->all();
        $input = $request->input();
        $value = $request->category_name; // lấy giá trị input với POST và nên dùng cách này để lấy values của form
        $photo = $request->photo;
        dd($photo);
        /**
         * http://localhost:8000/categories/add
         * thêm dữ liệu vào form rồi ấn btn thì sau đó sẽ hiện arr ['category_name'=> ..., '_token'=>...]
        */
//        return redirect(route('categories.add'));
//        return 'Submit thêm chuyên mục';
    }
    // lấy ra 1 chuyên mục theo id (GET)
    function getCategory($id)
    {
        return view('clients/categories/edit', ['id'=>$id]);
    }
    //Cập nhật 1 chuyên mục (GET)
    function updateCategory($id)
    {
        return 'Submit sửa chuyên mục: '.$id;
    }
    //
    // xóa chuyên mục theo id (GET)
    function deleteCategory($id)
    {
        return 'Submit xóa chuyên mục '.$id;
    }
}
