<?php

namespace App\Http\Controllers;

use App\Models\Mechanics;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    //
    function index()
    {
        // từ mechanic rồi tìm ra owner thông qua car
        $owner = Mechanics::find(1)->carOwner;
        dd($owner);
    }
}
