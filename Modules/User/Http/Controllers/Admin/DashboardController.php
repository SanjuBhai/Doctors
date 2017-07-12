<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Admin;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }
    
    public function index()
    {
        return view('user::admin.dashboard');
    }
}