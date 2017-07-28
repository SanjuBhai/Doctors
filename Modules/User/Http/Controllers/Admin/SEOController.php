<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator, Auth, Session;
use Modules\User\Http\Middleware\Admin;

class SEOController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    public function list()
    {
        
    }

    public function add()
    {
        	
    }

    public function update()
    {
    	
    }

    public function delete()
    {
    	
    }
}