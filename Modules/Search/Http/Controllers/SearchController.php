<?php

namespace Modules\Search\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Request, Session, DB;
use Modules\User\Models\Doctor\Specialization; 
use Modules\User\Models\Doctor\Doctor;
use Modules\Search\Models\DoctorSearch;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // Get specializations
        $specializations = Specialization::where('status', 1)->get();
        
        return view('search::index')
            ->with('specializations', $specializations);
    }

    // Search
    public function search()
    {
        if( Request::isMethod('post') )
        {
            $arguments = Request::all();
            parse_str(str_replace('#', '', $arguments['filters']), $filters);
            
            $page = isset($filters['page']) ? $filters['page'] : 1;
            $per_page = $per_page_results = 1;
            $per_page = $arguments['pageload'] == 'true' ? $page * $per_page : $per_page;

            $offset = $arguments['pageload'] == 'true' ? 0 : ($page-1) * $per_page;

            // Get Doctors
            $select = array('doctor_id');
            $doctors = DB::table('doctors_search as ds')
                ->select('doctor_id')
                ->where('ds.status', 1);

            $doctorsCount = DB::table('doctors_search as ds')
                ->where('ds.status', 1);
            
            // Get gender
            if( isset($filters['gender']) && $filters['gender'] ) 
            {
                $gender = str_replace(array('m', 'f'), array('male', 'female') , $filters['gender']);
                $doctors->whereIn('ds.gender', explode(',', $gender));
                $doctorsCount->whereIn('ds.gender', explode(',', $gender));
            }

            // Get fees
            if( isset($filters['fees']) && $filters['fees'] )
            {
                list($min, $max) = explode(',', $filters['fees']);
                $doctors->where('ds.clinic_fees', '>=', $min)->where('ds.clinic_fees', '<=', $max);
                $doctorsCount->where('ds.clinic_fees', '>=', $min)->where('ds.clinic_fees', '<=', $max);
            }

            // Get specialities
            if( isset($filters['speciality']) && $filters['speciality'] ) 
            {
                $doctors->whereIn('ds.speciality_id', explode(',', $filters['speciality']));
                $doctorsCount->whereIn('ds.speciality_id', explode(',', $filters['speciality']));
            }

            // Get main filter
            if( isset($filters['find']) && $filters['find'] )
            {
                $doctors->whereRaw("MATCH(ds.data) AGAINST ('".$filters['find']."*' IN BOOLEAN MODE)");
                $doctorsCount->whereRaw("MATCH(ds.data) AGAINST ('".$filters['find']."*' IN BOOLEAN MODE)");
            }

            // Get city
            $city = isset($filters['city']) ? $filters['city'] : '';
            
            // Get locality
            $locality = isset($filters['locality']) ? $filters['locality'] : '';
            
            // Get lat long of selected location 
            $latlong = getLatLong($city.' '.$locality);
            if( $latlong ) 
            {
                $doctors->addSelect( DB::raw('SQRT(POW(69.1 * (ds.clinic_latitude - '.$latlong['latitude'].'), 2) + POW(69.1 * ('.$latlong['longitude'].' - ds.clinic_longitude) * COS(ds.clinic_latitude / 57.3), 2)) AS distance'))->orderBy('distance', 'ASC')->havingRaw('distance < 10');
                $doctorsCount->whereRaw( DB::raw('(POW(69.1 * (ds.clinic_latitude - '.$latlong['latitude'].'), 2) + POW(69.1 * ('.$latlong['longitude'].' - ds.clinic_longitude) * COS(ds.clinic_latitude / 57.3), 2)) < 10'));
            }

            // echo $doctors->toSql(); exit;
            // print_r($doctors->get());exit;
            
            $ids = $distances = array();
            $total = $doctorsCount->count();
            $pages = ceil($total / $per_page_results);
            $doctors = $doctors->take($per_page)->skip($offset)->get();
            foreach ($doctors as $key => $value) 
            {
                $ids[] = $value->doctor_id;
                if( $latlong ) {
                    $distances[$value->doctor_id] = $value->distance;
                }
            }

            $doctors = array();
            if( $ids )
            {
                $doctors = DB::table('doctors as d')
                    ->whereIn('d.doctor_id', $ids)
                    ->join('specializations as s', 's.id', '=', 'd.speciality_id')
                    ->select('d.doctor_id', 'd.prefix', 'd.name', 'd.slug', 'd.image', 'd.gender', 'd.clinic_fees', 'd.experience', 'd.rating_count', 'd.qualifications', 's.name as speciality')
                    ->orderByRaw( DB::raw("field(d.doctor_id,".implode(',', $ids).")" ) )
                    ->get();
            }

            return json_encode( array(
                'status' => 'success',
                'pages' => $pages,
                'page' => $page,
                'total' => $total,
                'data' => view('search::search-results')
                    ->with('doctors', $doctors)
                    ->with('distances', $distances)
                    ->render() 
            ) );
        }
    }
}
