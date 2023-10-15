<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    //
    function index()
    {
        $title = "Danh Sách Người Dùng";
        $users =  DB::select('SELECT * FROM users ORDER BY create_at DESC ');
        return view('clients.users.lists', compact('title', 'users'));
    }
}
