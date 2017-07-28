<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |------------------------------------------------::--------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    private $admin_role_id = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('user::admin.login');
    }

    /**
     * Log the user out of the application. (overridden)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request, $message = '')
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        if( $message ) {
            $request->session()->put('error', $message);
        }

        return redirect()->route('admin.login');
    }

    /**
     * The user has been authenticated. (overridden)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Check of current user is authorised
        if( $user->role_id != $this->admin_role_id ) {
            $this->logout($request, 'You are not authorised.');
        }
        
        return redirect( $this->redirectPath() );
    }
}
