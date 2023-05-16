<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Appointments;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    public function myAppointments(Request $req){

        if( Auth::id() ){

            if ( Auth::user()->usertype == 0 )
            {  
                $userID = Auth::user()->id;
                if ( $req->ajax() ) {

                    $data = events::whereDate( 'start', '>=', $req->start )
                                    ->whereDate( 'end', '<=', $req->end )
                                    ->where( 'userID', $userID )
                                    ->get([ 'id', 'title', 'start', 'end' ]);
                    return response()->json($data);
                }
                

                $appointments = appointments::where( 'userId', $userID )->get();            
    
                return view( 'user.my-appointments', compact( 'appointments' ) );
            }
            else
            {
                if ( $req->ajax() ) {

                    $data = events::whereDate( 'start', '>=', $req->start )
                                    ->whereDate( 'end', '<=', $req->end )
                                    ->get([ 'id', 'title', 'start', 'end' ]);
                    return response()->json($data);
                }
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

    public function findHospitals()
    {
        if( Auth::id() )
        {
            if ( Auth::user()->usertype == 0 )
            {  
                return view( 'user.hospitals' );
            }
        }
        else 
        {
            return view( 'user.hospitals' );
        }
    }

    public function profile()
    {
        if( Auth::id() )
        {
            return view( 'user.profile' );
        }
    }

    public function edit()
    {
        if( Auth::id() )
        {
            return view( 'user.edit-profile' );
        }
    }

    public function update_profile( Request $req )
    {
        $user = user::find(Auth::id());

        $user->forceFill([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make( $req->new_password ),
            ])->save();

        return redirect()->back()->with('success', 'User details updated');  
    }

    public function find_hospitals()
    {
        return view('user.find-hospitals');
    }
}
