<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth, DB, Session, Validator;
use App\User;
use Modules\User\Models\Doctor\Doctor;
use Modules\Appointment\Models\Schedule;
use Modules\User\Http\Middleware\Doctor as DoctorMiddleware;

class CalendarController extends Controller
{
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
        $begin = new \DateTime();
        $end = new \DateTime();
        $period = new \DatePeriod( $begin, new \DateInterval('P1D'), $end->modify('+30 days') );

        $dates = array();
        foreach($period as $date) 
        {
            $day = $date->format("Y-m-d");
            $dates[$day]['day'] = $date->format('D');
            $dates[$day]['date'] = $date->format('d');
            $dates[$day]['month'] = $date->format('M');
        }

        // Get schedules
        $schedules = Schedule::select('id', 'date', 'time', 'is_used')
            ->where('user_id', Auth::user()->id)
            ->where('date', '>=', $begin->format('Y-m-d'))
            ->where('date', '<', $end->format('Y-m-d'))
            ->get()
            ->toArray();

        if( $schedules )
        {
            foreach ($schedules as $key => $value) {
                $dates[ $value['date'] ]['schedules'][$value['id']] = array(substr($value['time'], 0, -3), $value['is_used']==1?'used':'not-used');
            }
        }

        // print_r($dates);exit;
        return view('user::doctor.calendar.index')->with([
            'schedules' => $schedules,
            'dates'     => $dates,
            'beginDate' => $begin,
            'endDate'   => $end
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
        // Interval in seconds
        $interval = 1800;

        $datetime1 = date('Y-m-d').' '.$request->get('start_time').':00';
        $datetime2 = date('Y-m-d').' '.$request->get('end_time').':00';

        $start_time     = strtotime( $datetime1 );
        $end_time    = strtotime( $datetime2 );
        if( $end_time <= $start_time ) 
        {
            Session::flash('error', 'End time must be greater than selcted start time.');
            return redirect()->back();
        }

        $intervals = array();
        for ($i = $start_time; $i < $end_time; $i += $interval) {
            array_push($intervals, date('H:i', $i));
        }

        if( !empty( $intervals ) )
        {
            $user_id = Auth::user()->id;
            $begin = new \DateTime();
            $end = new \DateTime();
            $period = new \DatePeriod( $begin, new \DateInterval('P1D'), $end->modify('+30 days') );

            foreach($period as $date)
            {
                $day = $date->format("Y-m-d");
                foreach ($intervals as $key => $value) 
                {
                    $array[] = array(
                        'date' => $day,
                        'time' => $value,
                        'user_id' => $user_id
                    );
                }
            }
        }

        // Save into DB
        DB::table('schedules')->insert($array);

        Session::flash('success', 'Schedules added successfully.');
        return redirect()->back();
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
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
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
            $data = json_decode($request->get('data'));
            if( empty( $data ) ) {
                throw new \Exception("No schedules selected", 1);
            }

            $deleted = Schedule::whereIn('id', $data)->delete();
            return 'true';

        } catch( \Exception $e) {
            return $e->getMessage();
        }
        
        exit;
    }
}