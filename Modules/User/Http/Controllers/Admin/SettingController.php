<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Admin;
use Validator, Auth, Session, DB, Request;
use App\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    // Show settings
    public function index()
    {
        $settings = array();
        $all = Setting::select(['name', 'value'])->get();
        foreach($all as $key => $val) {
            $settings[ $val->name ] = $val->value;
        }

        return view('user::admin.settings')
            ->with('user', Auth::User())
            ->with('settings', $settings);
    }
    
    // Save settings
    public function store()
    {
        if( Request::isMethod('post') )
        {
            $args = trim_and_remove_tags( Request::all() );
            unset( $args['_token'] );
            if( Request::hasFile('home_page_banner') ) 
            {
                $image = Request::file('home_page_banner');
                $image_name = generateUniqueFileName($image->getClientOriginalExtension());
                if( $image->move(public_path('uploads/'.date('Y-m')), $image_name) ) 
                {
                    unset( $args['home_page_banner'] );
                    DB::table('settings')->where('name', 'home_page_banner')->update(['value' => $image_name]);
                } else {
                    Session::flash('error', 'Unable to upload image.');
                }
            }
            
            foreach($args as $key => $val) {
                DB::table('settings')->where('name', $key)->update(['value' => $val]);
            }
            
            Session::flash('success', 'Settings updated successfully.');
        }

        return redirect()->back();
    }
}