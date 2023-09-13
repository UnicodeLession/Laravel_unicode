<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Hiển thị Danh sách chuyên mục (GET)
    function index() {
        return view('clients/categories/lists');
    }
//    CRUD : Create, Read, Update, Delete
    // show form thêm data (GET)
    function addCategory()
    {
        return view('clients/categories/add');
    }
    // Tạo thêm 1 chuyên mục (POST)
    function handleAddCategory()
    {
        return redirect(route('categories.add'));
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
