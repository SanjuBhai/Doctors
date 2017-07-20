<?php

namespace Modules\User\Http\Controllers\Doctor;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
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
    protected $redirectTo = '/doctor/register/completed';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' =>['thanks']] );
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'prefix' => 'required|in:Dr.,Dt.,Mr.,Ms.,Mrs.',
            'speciality_id' => 'required|integer',
            'medical_registration_number' => 'required|unique:doctors'
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
        $user = User::create([
            'first_name' => $data['name'],
            'email'     => $data['email'],
            'role_id'   => 2,
            'password'  => bcrypt($data['password']),
        ]);

        if( $user )
        {
            Doctor::create([
                'doctor_id' => $user->id,
                'prefix' => $data['prefix'],
                'name' => $data['name'],
                'speciality_id' => $data['speciality_id'],
                'status' => 0
            ]);
        }

        return $user;
    }

    /**
     * Handle a registration request for the application. (overridden)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
        Session::flash('doctor-signup', 'Check your email for confirmation link. You will have to wait until your Medical Registration Number gets verifed by our experts.');
        
        // Send mail to user
        // Mail::to( $user->email )->send(new Register( $user ));

        return redirect()->route('doctor.signup.completed')->with('user', $user);
    }

    // Register form
    public function index()
    {
        $user = new User;
        
        $doctor = New Doctor;
        
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

    // Show registration confirmation page
    public function thanks()
    {
        if( ! Session::has('doctor-signup') ) {
            return redirect('/');
        }
        
        $this->guard()->login( Session::get('user') );
        
        return view('user::doctor.registration-completed');
    }
}
