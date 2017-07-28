<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth, Session, Validator;
use App\User;
use Modules\User\Traits\Filter;
use Modules\User\Http\Middleware\Admin;

class UserController extends Controller
{
    use Filter;

    private $role_id = 2;

    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = User::where('role_id', $this->role_id);

        // Filter records
        $model = $this->filter($model);

        return view('user::admin.users.index')->with([
            'users' => $model,
            'filters' => $this->getFilters(),
            'showing' => $this->showing($model),
            'perPageArray' => $this->getPerPageArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if( $validator->fails() ) {
            return view('user::admin.users.create')->withErrors( $validator->errors() );
        }

        // Add user
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
            'is_email_verified' => 1
        ]);

        if( $user )
        {
            Session::flash('success', 'User added successfully.');
            return redirect()->route('admin.users');
        }
        
        Session::flash('error', 'Unable to create user at the moment. Please try after some time.');
        return view('user::admin.users.create');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($user_id)
    {
        $user = User::find( $user_id );
        if( !$user ) 
        {
            Session::flash('error', 'Invalid user.');
            return redirect()->route('admin.users');
        }

        return view('user::admin.users.show')->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($user_id)
    {
        $user = User::find( $user_id );
        if( ! $user ) {
            Session::flash('error', 'Invalid user.');
            return redirect()->route('admin.users');
        }

        return view('user::admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $user_id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user_id
        ]);

        $user = User::find($user_id);
        if( $validator->fails() ) 
        {
            return view('user::admin.users.edit')
                ->with('user', $user)
                ->withErrors( $validator->errors() );
        }
        
        // Update user
        $user->fill( $data );
        $user->push();

        Session::flash('success', 'User profile updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete(Request $request)
    {
        try
        {
            $user = User::find($request->get('user'));
            if( !$user ) {
                throw new \Exception("User not found", 1);
            }

            $user->delete();
            return 'true';

        } catch( \Exception $e) {
            return $e->getMessage();
        }

        exit;
    }

    // Get filters on listing page (overridden)
    public function getFilters()
    {
        return array(
            'name' => array(
                'key' => 'first_name',
                'operator' => 'like',
                'label' => 'First Name',
                'type' => 'text',
                'id' => 'name'
            ),
            'email' => array(
                'key' => 'email',
                'operator' => '=',
                'label' => 'Email',
                'type' => 'email',
                'id' => 'email'
            ),
            'phone' => array(
                'key' => 'phone',
                'operator' => '=',
                'label' => 'Phone',
                'type' => 'text',
                'id' => 'phone'
            )
        );
    }
}