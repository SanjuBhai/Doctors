<?php

namespace Modules\User\Http\Middleware;

use Closure, Auth;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( !Auth::check() ) {
            return redirect( route('admin.login') );    
        }

        // Check if current user is authorised
        if( Auth::user()->role_id != 1 ) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
