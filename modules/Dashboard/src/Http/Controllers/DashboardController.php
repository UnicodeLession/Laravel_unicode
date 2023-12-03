<?php

namespace Modules\Dashboard\src\Http\Controllers;

//use Modules\Dashboard\src\Models\Dashboard;
use App\Http\Controllers\Controller;
use Modules\Dashboard\src\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Trang Tổng Quan';
        return view('dashboard::dashboard', compact('pageTitle'));
    }
}
