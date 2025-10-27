<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Admin dashboard landing page.
 */
class DashboardController extends Controller
{
    /**
     * Render admin dashboard view.
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}
