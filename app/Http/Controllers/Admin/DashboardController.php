<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Return admin dashboard view
    public function index()
    {
        return view('admin.dashboard');
    }
}
