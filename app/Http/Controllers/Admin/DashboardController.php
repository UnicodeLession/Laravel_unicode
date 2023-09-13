<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        // xử dụng session để check login (đang học về middleware)

    }

    function index(){
        return '<h2>Dashboard Welcome</h2>';
    }
}
