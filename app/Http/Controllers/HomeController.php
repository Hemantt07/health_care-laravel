<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Models\Doctors;
use App\Models\Appointments;
use App\Models\Events;

class HomeController extends Controller
{
    public function redirect()
    {
        if( Auth::id() ){
            if ( Auth::user()->usertype == 0 ) {   
                $doctors = doctors::all();
                return view('user.home', compact( 'doctors' ));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }

    }

    public function index()
    {
        $doctors = doctors::all();
        if( Auth::id() ){
            if ( Auth::user()->usertype == 0 ) {  
                return view('user.home', compact( 'doctors' ));
            } else {
                return view('admin.home', compact( 'doctors' ));
            }
        } else {
            return view('user.home', compact( 'doctors' ));
        }
        
    }

}
