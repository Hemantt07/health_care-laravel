<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function about(){
        $doctors = doctors::all();
        return view( 'user.about', compact( 'doctors' ) );
    }

    function doctors(){
        $doctors = doctors::all();
        return view( 'user.doctors', compact( 'doctors' ) );
    }

    function myAppointments(){

        if( Auth::id() ){

            $userID = Auth::user()->id;

            $doctors = doctors::all();

            $appointments = appointments::where( 'userId', $userID )->get();            

            return view( 'user.my-appointments', compact( 'appointments','doctors' ) );

        }
        else{
            return redirect()->back();
        }


    }
}
