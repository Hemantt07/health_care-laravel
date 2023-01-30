<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // about
    public function about(){

        $doctors = doctors::all();
        return view( 'user.about', compact( 'doctors' ) );
        
    }

    // doctors
    public function doctors(){
        $doctors = doctors::all();

        if( Auth::id() ){

            if ( Auth::user()->usertype == 0 )
            {  
                return view( 'user.doctors', compact( 'doctors' ) );
            }
            else
            {
                return view( 'admin.doctors', compact( 'doctors' ) );
            }
        }
        else
        {
            return view( 'user.doctors', compact( 'doctors' ) );
        }


    }

    // myAppointments
    public function myAppointments(){

        if( Auth::id() ){

            if ( Auth::user()->usertype == 0 )
            {  
                $userID = Auth::user()->id;

                $appointments = appointments::where( 'userId', $userID )->get();            
    
                return view( 'user.my-appointments', compact( 'appointments' ) );
            }
            else
            {
                $appointments = appointments::all();

                return view( 'admin.appointments', compact( 'appointments' ) );
            }


        }
        else{
            return redirect()->back();
        }

    }

    // appointment
    public function appointment( $appointment_id )
    {

        if( Auth::id() )
        {
            if ( Auth::user()->usertype == 0 )
            {  
                $appointment = appointments::where( 'id', $appointment_id )->get();

                return view( 'user.appointment', compact( 'appointment' ) );
            }
            else
            {
                $appointment = appointments::where( 'id', $appointment_id )->get();

                return view( 'admin.appointment', compact( 'appointment' ) );
            }
        }
    }
}
