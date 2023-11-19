<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    //
    function index(){
        return view('admin.posts.lists');
    }
    function add(User $user) {
//        if(Gate::allows('posts.add')){
//            return 'Có quyền thêm bài viết'; // sẽ trả về kết quả này khi bên AuthServiceProvider trả về true
//        }
//        if (Gate::denies('posts.add')){
//            return 'Không có quyền thêm bài viết'; // sẽ trả về kết quả này khi bên AuthServiceProvider trả về false
//        }
//        return "Thêm Bài Viết";
        $user = User::find(98);
        if(Gate::forUser($user)->allows('posts.add')){
            return 'Người này được phép thêm bài post';
        }
    }
    function edit($id){
        $post = Posts::find($id);
        $user = User::find(98);
        // khi chỉ được phép sửa bài viết khi đăng nhập đúng người đăng post
        if (Gate::allows('posts.update', $post)){
            return 'Cho phép sửa bài viết '.$id;
        }
        if (Gate::denies('posts.update', $post)){
            return 'Không cho phép sửa bài viết '.$id;
        }
        return 'Sửa bài viết có id='.$id;
    }
}
