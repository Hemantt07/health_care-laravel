<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Models\Doctors;
use App\Models\Appointments;

class HomeController extends Controller
{
    public function redirect()
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

    public function index()
    {
        $doctors = doctors::all();
        return view('user.home', compact( 'doctors' ));
         
    }

    public function make_appointment(){

        $doctors = doctors::all();
        return view( 'user.make-an-appointment', compact( 'doctors' ) );
        
    }

    public function cancelAppointment( $appointment_id ){
        $appointment = appointments::find( $appointment_id );
        $appointment->delete();

        return redirect( route('my-appointments') )->with( 'message', 'Appointment cancelled successfully..!' );
    } 

}
