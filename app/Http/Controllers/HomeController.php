<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Models\Doctors;

class HomeController extends Controller
{
    function redirect()
    {
        if( Auth::id() )
        {
            if ( Auth::user()->usertype == 0 )
            {   
                $doctors = doctors::all();
                return view('user.home', compact( 'doctors' ));
            }
            else
            {
                return view('admin.home');
            }
        }
        else
        {
            return redirect()->back();
        }

    }

    function index()
    {
        $doctors = doctors::all();
        return view('user.home', compact( 'doctors' ));
         
    }

    function make_appointment(){

        $doctors = doctors::all();
        return view( 'user.make-an-appointment', compact( 'doctors' ) );
        
    }

}
