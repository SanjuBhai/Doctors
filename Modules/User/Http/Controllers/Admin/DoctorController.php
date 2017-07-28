<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth, DB, Session, Validator;
use App\User, Modules\User\Models\Doctor\Doctor;
use Modules\User\Traits\Filter;
use Modules\User\Http\Middleware\Admin;

class DoctorController extends Controller
{
    use Filter;

    private $role_id = 3;

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
        $model = DB::table('users')
            ->where('users.role_id', $this->role_id)
            ->join('doctors', 'users.id', '=', 'doctors.doctor_id')
            ->join('specializations', 'doctors.speciality_id', '=', 'specializations.id')
            ->select('users.id', 'users.email', 'doctors.prefix', 'doctors.name', 'doctors.medical_registration_number', 'doctors.clinic_fees', 'doctors.status', 'doctors.clinic_name', 'doctors.clinic_locality', 'specializations.name as specialization');
            // ->where('users.is_email_verified', 1);

        // Filter records
        $this->setOrderBy('users.created_at');
        $model = $this->filter($model);
        
        return view('user::admin.doctors.index')->with([
            'doctors' => $model,
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
        
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($user_id)
    {
        $user = User::with(['doctor' => function($query){
            $query->with('specialization');
        }])->find( $user_id );

        if( !$user )
        {
            Session::flash('error', 'Invalid user.');
            return redirect()->route('admin.doctors');
        }

        return view('user::admin.doctors.show')->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($user_id)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $user_id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete(Request $request)
    {
        try
        {
            $doctor = Doctor::find($request->get('user'));
            if( !$doctor ) {
                throw new \Exception("Doctor not found", 1);
            }

            $doctor->delete();
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
                'key' => 'doctors.name',
                'operator' => 'like',
                'label' => 'Name',
                'type' => 'text',
                'id' => 'name'
            ),
            'clinic_name' => array(
                'key' => 'doctors.clinic_name',
                'operator' => 'like',
                'label' => 'Clinic Name',
                'type' => 'text',
                'id' => 'clinic_name'
            ),
            'medical_registration_number' => array(
                'key' => 'medical_registration_number',
                'operator' => '=',
                'label' => 'Medical Registration Number',
                'type' => 'text',
                'id' => 'medical_registration_number'
            )
        );
    }
}