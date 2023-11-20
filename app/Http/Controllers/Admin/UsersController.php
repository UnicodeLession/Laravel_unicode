<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    function index()
    {
        $lists = User::all();
        return view('admin.users.lists', compact('lists'));
    }
    function add(){
        return view('admin.users.add');
    }

    function edit(User $user)
    {
        return view('admin.users.edit');
    }
    function postEdit(User $user){

    }
    function delete(User $user){

    }
}
