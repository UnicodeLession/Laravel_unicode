## Tạo mới project laravel

##  Start Server
```terminal
php artisan serve
```
```terminal
npm run dev
```
## [Deploy project -> Heroku](https://online.unicode.vn/bai-hoc/bai-116-laravel-social-login-tich-hop-dang-nhap-facebook-phan-2)

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
```terminal
php artisan migrate
```
=> check db và sẽ tạo table users... trong db đó
+ Laravel cho phép thay đổi các tham số trong dạng cột, tên cột,... để thực hiện phải cài : ``
```terminal
composer require doctrine/dbal 
```
5. chế độ bảo trì
```terminal
php artisan down
```
6. chuyển về chế độ bình thường
```terminal
php artisan up
```
7. Tạo Hàm Helper với autoload:
   b1: Tạo app/Helpers/Functions.php
   b2: vào composer.json đến "autoload" dưới psr-4 thêm ___"files": ["app/Helpers/Functions.php"]___
   b3: Chạy lệnh dưới
```terminal
composer dump-autoload
```

## Authentication
+ ### Cài đặt
+ bước 1:
```terminal
composer require laravel/ui
```
+ bước 2:
```terminal
php artisan ui bootstrap --auth
```
+ bước 3:
```terminal
npm run dev
```
```terminal
php artisan migrate
```
+ bước 4: restart laravel
```terminal
php artisan serve
```

## Socialite: tích hợp login và register với Facebook, Twitter,...
+ bước 1:
```termial
composer require laravel/socialite
```
```php - config/app.php 
```

## [Debug Laravel](https://github.com/barryvdh/laravel-debugbar)
+ bước 1: Cài:
```termial
composer require barryvdh/laravel-debugbar --dev
```
+ bước 2: ném vào config/app.php -> providers array:
```php
'providers' => [
    // ...
    Barryvdh\Debugbar\ServiceProvider::class,
],

```
+ bước 3:
```termial
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

## [Table Render Value](https://yajrabox.com/docs/laravel-datatables/10.0)
+ bước 1:
```terminal 
composer require yajra/laravel-datatables-oracle:"^10.3.1"
```
+ bước 2: ném vào config/app.php -> providers array
```php
'providers' => [
    // ...
    Yajra\DataTables\DataTablesServiceProvider::class,
],
```
+ bước 3:
```terminal
php artisan vendor:publish --tag=datatables
```

## Các kiểu khác
0. khi
```php
dd($variable)
```
thì cái #messages: array:2 [▶] gọi là [Collections](https://laravel.com/docs/10.x/collections)
1. tạo middleware
```terminal
php artisan make:middleware MiddelwareName 
```
- sẽ tạo file trong ___app/http/Middleware___
- sau khi tạo xong middleware thì phải khai báo trong Kernel.php trong protected $middleware
- thường áp dụng trong route group để khi truy cập vào con của group thì sẽ chuyển về middleware route đã khai báo

2. Tạo Controller
```terminal
php artisan make:controller HomeController
```
- sẽ tạo file trong ___app/http/Controller___
```terminal
php artisan make:controller Admin/ProductsController --resource
```
- Tạo ra Controller và dựng sẵn kiểu
3. Tạo Component
```terminal
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
```terminal
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

## DATABASE Laravel
### 3 phương thức truy vấn DB laravel
+ #### Truy vấn SQL thuần
    + #### Query Builder
        + ```php
      DB::table('table_name')->get() // lấy ra all dữ liệu của bảng
      DB::table('table_name')->first() // lấy ra 1 bản ghi đầu tiên dữ liệu của bảng
        + ```php
      // https://laravel.com/docs/10.x/queries#additional-where-clauses
      // https://www.w3schools.com/sql/sql_where.asp

      DB::table('table_name')->where('column', 'compare', 'value')
      //compare: '>' ; '<' ; '>=' ; '<=' ; '!=' | nếu không có thì sẽ là '=' | compare: '<>' = khác
      // 2 cái dưới giống nhau và dạng (WHERE ... AND ...)
      ->where('id', '>=', '2') -> where('id', '<', '7')
      ->where([['id', '>=', '2'], ['id', '<', '7']])
      
      ->orWhere('id', 7) // WHERE ... OR id = 7 => lấy thêm id = 7
      ->whereIn('id', [1,2,3]) // rút gọn của một đống or
      
      // câu lệnh tìm kiếm - pattern: https://www.w3schools.com/sql/sql_like.asp
      ->where('column', 'like', 'pattern')
      
      // truy vấn trong khoảng
      ->whereBetween('id', [2, 7])
      // truy vấn ngoài khoảng
      ->whereNotBetween('id', [2, 7])
        + ```php
      DB::table('table_name')
        + ```php
      //! debug 
      DB::table('table_name')->...->toSql() // lấy ra câu lệnh sql
      
      // thêm câu lệnh vào trên cùng function
      DB::enableQueryLog();
      // show sql, bindings, time_:
      dd(DB::getQueryLog);

        + ```php
      //Nối bảng
      
      //inner join : có group_id thì mới render
      DB::table($this->table)
        ->join('groups', 'users.group_id', '=', 'groups.id')
        ->select('users.*', 'groups.name as group_name')
      // khi đó sẽ trả về tất cả của users cùng với group.name mà trong users.group_id khác null
      
      //left join: bảng bên trái(users) render ra hết mặc kệ có giá trị nối(group_id) hay không
      DB::table($this->table)
        ->leftJoin('groups', 'users.group_id', '=', 'groups.id')
        ->select('users.*', 'groups.name as group_name')
      
      //right join: bảng bên phải(groups) render ra hết mặc kệ có giá trị nối (group_id) hay không
      DB::table($this->table)
        ->rightJoin('groups', 'users.group_id', '=', 'groups.id')
        ->select('users.*', 'groups.name as group_name')
        + ```php 
      //Sắp xếp
      
      //sắp xếp 1 cột
      DB::table('users')
        ->orderBy('name', 'desc')
      
      //sắp xếp nhiều cột
      DB::table('users')
        ->orderBy('name', 'desc')
        ->orderBy('email', 'asc')
      
      //sắp xếp ngẫu nhiên
      DB::table('users')
        ->inRandomOrder()
        + ```php

+ #### Migration
+ Trong table migrations thì batch là sau khi refresh thì lần khởi tạo `php artisan migrate` thì batch sẽ là 1 và các lần khởi tạo tiếp theo thì sẽ lần lượt tăng
+ rollback về migrate thứ mấy:
    + mở bảng migrations trong db
    + xác định batch muốn rollback về
    + với các migration chung 1 giá trị batch thì có bao nhiêu migration thì có bấy nhiêu __bước__
        + `php artisan migrate:rollback --step=3`
        + với lấy rollback step = 3  sẽ lấy batch to nhất rồi đến cái __bước__ cuối cùng của batch đó
        + rồi sau khi rollback thì nó sẽ quay trở lại 3 bước có thể hiểu là sẽ mất đi 3 migrations


* **_Custom Guard_**: Muốn dùng Authetication với nhiều chức vụ khác nhau như: các user vừa là admin vừa là user và mong muốn login admin có thể kế thừa login như user thì phải 
