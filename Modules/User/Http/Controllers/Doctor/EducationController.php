<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth, DB, Session, Validator;
use App\User;
use Modules\User\Models\Doctor\Doctor;
use Modules\User\Models\Doctor\DoctorEducation;
use Modules\User\Traits\Filter;
use Modules\User\Http\Middleware\Doctor as DoctorMiddleware;

class EducationController extends Controller
{
    use Filter;

    public function __construct()
    {
        $this->middleware(DoctorMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = DoctorEducation::where('doctor_id', Auth::user()->id);

        // Filter records
        $model = $this->filter($model);

        return view('user::doctor.educations.index')->with([
            'educations' => $model,
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
        return view('user::doctor.educations.create');
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
            'title' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'from_year' => 'required|digits:4',
            'to_year' => 'required|digits:4',
        ]);

        if( $validator->fails() ) {
            return view('user::doctor.educations.create')->withErrors( $validator->errors() );
        }

        // Add education
        $education = DoctorEducation::create([
            'doctor_id' => Auth::user()->id,
            'title' => $data['title'],
            'institute' => $data['institute'],
            'from_year' => $data['from_year'],
            'to_year' => $data['to_year']
        ]);

        if( $education )
        {
            Session::flash('success', 'Education added successfully.');
            return redirect()->route('doctor.educations');
        }

        Session::flash('error', 'Unable to create education at the moment. Please try after some time.');
        return view('user::doctor.educations.create');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $education = DoctorEducation::find( $id );
        if( ! $education ) {
            Session::flash('error', 'Invalid id.');
            return redirect()->route('doctor.educations');
        }

        // Verify ownership
        if( $education->doctor_id != Auth::user()->id ){
            Session::flash('error', 'You are not authorised.');
            return redirect()->route('doctor.educations');
        }

        return view('user::doctor.educations.edit')->with('education', $education);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'from_year' => 'required|digits:4',
            'to_year' => 'required|digits:4',
        ]);

        $education = DoctorEducation::find($id);
        if( $validator->fails() ) 
        {
            return view('user::doctor.educations.edit')
                ->with('education', $education)
                ->withErrors( $validator->errors() );
        }
        
        // Update education
        $education->fill( $data );
        $education->push();

        Session::flash('success', 'Education updated successfully.');
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
            $education = DoctorEducation::find($request->get('education'));
            if( !$education ) {
                throw new \Exception("Education details not found", 1);
            }
            
            $education->delete();
            return 'true';

        } catch( \Exception $e) {
            return $e->getMessage();
        }
        
        exit;
    }
}