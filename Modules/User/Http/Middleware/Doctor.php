<?php

namespace Modules\User\Http\Middleware;

use Closure, Auth;
use Illuminate\Http\Request;

class Doctor
{

    private $doctor_role_id = 3;

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
            return redirect( 'login' );
        }

        // Check if current user is doctor
        if( Auth::user()->role_id != $this->doctor_role_id ) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
