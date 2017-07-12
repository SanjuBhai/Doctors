<?php

namespace Modules\User\Http\Controllers\Doctor;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Modules\User\Emails\Dcotor\Register;
use Session, Mail;
use Modules\User\Models\Doctor\Doctor;
use Modules\User\Models\Doctor\Specialization;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * The user has been registered. (overridden)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Session::flash('success', 'Check your email for confirmation link.');
        
        // Send mail to user
        Mail::to( $user->email )->send(new Register( $user ));

        return redirect( $this->redirectPath() );
    }

    // Register form
    public function index()
    {
        $user = new User;
        
        $doctor = new Doctor;

        $prefix = array('Dr.', 'Dt.', 'Mr.', 'Ms.', 'Mrs.');
        
        // Get all specialities
        $specialities = Specialization::where('status', 1)->pluck('name', 'id')->all();
        
        return view('user::doctor.register')->with([
            'prefix'        => $prefix,
            'specialities'  => $specialities,
            'user'          => $user,
            'doctor'        => $doctor
        ]);
    }
}
