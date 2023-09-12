<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('name/{name?}', function (string $name) {
    return 'Tên của bạn là: '.$name;
    /**
     * khi đó : http://localhost:8000/name/Nguyen-Minh-Hieu
     * sẽ render ra : Tên của bạn là: Nguyen-Minh-Hieu
     *
     * nếu : http://localhost:8000/name/
     * thì sẽ bị 404
     */
});
Route::get('web/{slug}-{id}.html',function ($id,$slug){
    $content = 'id: '.$id.'<br />';
    $content.= 'slug: '.$slug;
    return $content;
    /**
     * * http://localhost:8000/web/co-thu-4652302.html
     * khi đó slug: co | id: thu-4652302
     *
     * khi có nhiều param thì tham số bên trong url và bên trong funtion
     * + có thể khác nhau về vị trí và tên
     * + bắt buộc số lượng param của cả 2 phải bằng nhau
     * + vị trí params bên trong funtion sẽ có giá trị tương ứng với vị trí bên trong url
    */
});

