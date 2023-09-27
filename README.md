##  Start Server
```diff
php artisan serve
```

## Set up
0. Check:
- folder vendor và file .env
- nếu k có folder vendor thì 
- check trong php.ini và tìm đến `extension=zip` nếu có  `;` đằng trước thì xóa đi
- dùng `composer install` trong cmd để tạo lại folder vendor 
- nếu không có .env thì dùng .env.example để backup lại
1. Tạo App Key
```diff
php artisan key:generate
```
2. Thiết Lập Timezone
> __config/app.php__ : 'timezone' => 'Asia/Ho_Chi_Minh',
3. Thiết lập môi trường __*file .env*__
- > Ví dụ: Xây dựng chức năng thanh toán Paypal  
  APP_ENV=__local__      : call api sandbox  
  APP_ENV=__production__ : call api live
- > DEBUG:  
  APP_DEBUG=__true__ : khi code thì để true  
  APP_DEBUG=__false__ : deploy thì để false
4. Database
```diff
php artisan migrate
```
=> check db và sẽ tạo table users... trong db đó
5. chế độ bảo trì
```diff
php artisan down
```
6. chuyển về chế độ bình thường
```diff
php artisan up
```

## Các kiểu khác
0. khi 
```php
dd($variable)
```
thì cái #messages: array:2 [▶] gọi là [Collections](https://laravel.com/docs/10.x/collections)
1. tạo middleware 
```angular2html
php artisan make:middleware MiddelwareName 
```
- sẽ tạo file trong ___app/http/Middleware___
- sau khi tạo xong middleware thì phải khai báo trong Kernel.php trong protected $middleware
- thường áp dụng trong route group để khi truy cập vào con của group thì sẽ chuyển về middleware route đã khai báo

2. Tạo Controller
```angular2html
php artisan make:controller HomeController
```
- sẽ tạo file trong ___app/http/Controller___
```angular2html
php artisan make:controller Admin/ProductsController --resource
```
- Tạo ra Controller và dựng sẵn kiểu
3. Tạo Component
```angular2html
php artisan make:component Alert
```
- sẽ tạo file Alert.php trong ___app/View/Components___
- sẽ tạo file alert.blade.php trong ___resources/views/components___    
* ___Đăng ký component___: thêm vào `AppServiceProvider`
```php
use Illuminate\Support\Facades\Blade;
use App\View\Components\Alert;

function boot(){
    Blade::component('package-alert', \App\View\Components\Alert::class);
}
```
- `package-alert` : Tên dùng để gọi component bên view
- `Alert` : Tên class component đã tạo ở trên
* ___Gọi ra trong view___
```php
<x-package-alert />
```
* ___Gọi ra component khi 2 tên trùng nhau nhưng khác nhau bên trong folder___
- NOTE khi dùng `use` thì phải dùng alias `as`
```php
<x-input.button />
<x-forms-input />
```
* ___Truyền dữ liệu vào component___
* NOTE: trong class khai báo dạng camelCase nhưng bên view thì phân cách bởi -
* Trong Class Alert
```php
public $type, $message, $dataIcon;
public function __construct($type='', $message, $dataIcon)
{
    //
    $this->type = $type;
    $this->message =$message;
    $this->dataIcon = $dataIcon;
}
```
* Trong view
```php 
<x-package-alert type="danger" : message="Đặt hàng không thành công" : data-icon="check"/>
```

## Validation
0. Error : https://laravel.com/docs/10.x/validation#quick-displaying-the-validation-errors
1. validate() từ lớp Request()
- $request->validate($rule, $massage)
   
- $rule = ['name_input' => "[rule](https://laravel.com/docs/10.x/validation#available-validation-rules)"]
- $massage = ['name_input.rule'=> "massage"]
2. Form Request 
```php
php artisan make:request StorePostRequest
```
3. Class Validator()
```php
$validation=Validator::make($input, $rules, $messages,$attributes);
/**
 * ?  $input: là mảng dữ liệu chứa các dữ liệu cần validation ( thường truyền $request->all() )
 * ?  $attributes: là mảng chứa các tên trường (có thể bỏ trống)
*/
```
4. Tạo Rule
[Create Rule](https://laravel.com/docs/10.x/validation#custom-validation-rules)
```php
php artisan make:rule Uppercase
```
to use:
```php
use App\Rules\Uppercase;
 
$request->validate([
    'name' => ['required', 'string', new Uppercase],
]);
```
5. Custom $message trong lang khi dùng trans() : ___\vendor\laravel\framework\src\Illuminate\Translation\lang\en\validation.php___
