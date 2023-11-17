<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    // để quản lý cả controller Doctors
    function index() {
        return view('doctors.index');
    }
}
