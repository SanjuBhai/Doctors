<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth, DB, Session, Validator;
use App\User;
use Modules\User\Models\Doctor\Doctor;
use Modules\Appointment\Models\Appointment;
use Modules\User\Traits\Filter;
use Modules\User\Http\Middleware\Doctor as DoctorMiddleware;

class AppointmentController extends Controller
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
        $model = Appointment::where('provider_id', Auth::user()->id);

        // Filter records
        $model = $this->filter($model);

        return view('user::doctor.appointments.index')->with([
            'appointments' => $model,
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
        return view('user::doctor.videos.create');
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
            'video_url' => 'required|url'
        ]);

        if( $validator->fails() ) {
            return view('user::doctor.videos.create')->withErrors( $validator->errors() );
        }

        // Add video
        $video = DoctorVideo::create([
            'doctor_id' => Auth::user()->id,
            'title' => $data['title'],
            'video_url' => $data['video_url']
        ]);

        if( $video )
        {
            Session::flash('success', 'Video added successfully.');
            return redirect()->route('doctor.videos');
        }

        Session::flash('error', 'Unable to create video at the moment. Please try after some time.');
        return view('user::doctor.videos.create');
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
        $video = DoctorVideo::find( $id );
        if( ! $video ) {
            Session::flash('error', 'Invalid id.');
            return redirect()->route('doctor.videos');
        }

        // Verify ownership
        if( $video->doctor_id != Auth::user()->id ){
            Session::flash('error', 'You are not authorised.');
            return redirect()->route('doctor.videos');
        }

        return view('user::doctor.videos.edit')->with('video', $video);
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
            'video_url' => 'required|url'
        ]);

        $video = DoctorVideo::find($id);
        if( $validator->fails() ) 
        {
            return view('user::doctor.videos.edit')
                ->with('video', $video)
                ->withErrors( $validator->errors() );
        }
        
        // Update video
        $video->fill( $data );
        $video->push();

        Session::flash('success', 'Video updated successfully.');
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
            $video = DoctorVideo::find($request->get('video'));
            if( !$video ) {
                throw new \Exception("Video details not found", 1);
            }
            
            $video->delete();
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
                'key' => 'name',
                'operator' => 'like',
                'label' => 'Name',
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
            ),
            'start_date' => array(
                'key' => 'booking_datetime',
                'operator' => '>=',
                'label' => 'Start Date',
                'type' => 'text',
                'id' => 'start_date'
            ),
            'end_date' => array(
                'key' => 'book_datetime',
                'operator' => '<=',
                'label' => 'End Date',
                'type' => 'text',
                'id' => 'end_date'
            )
        );
    }
}