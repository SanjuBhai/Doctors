<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use URL, Module;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user::admin.dashboard');
    }
}