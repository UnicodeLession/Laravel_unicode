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
- Tạo ra Controller và dựng sẵn kiểu bên trong
- 
