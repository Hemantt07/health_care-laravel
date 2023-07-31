<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Appointments;
use App\Models\Events;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function make_appointment(){
        $doctors = doctors::all();
        if( Auth::id() ){
            if ( Auth::user()->usertype == 0 ){ 
                return view( 'user.make-an-appointment', compact( 'doctors' ) );
            } else {
                abort(404);
            }
        } else {
            return view( 'user.make-an-appointment', compact( 'doctors' ) );
        }
        
    }

    public function cancelAppointment( $appointment_id ){
        $event =  Events::where('appointmentId', $appointment_id)->first();
        $appointment = Appointments::find( $appointment_id );

        if ( Auth::user()->usertype == 0 ){  
            $appointment->delete();
            $event->delete();
            return redirect( route('my-appointments') )->with( 'message', 'Appointment cancelled successfully..!' );
        } else {
            $appointment->status = "Cancelled";
            $appointment->save();
            return redirect( route('my-appointments') )->with( 'message', 'Appointment cancelled successfully..!' );
        }
    }

    public function appointments( Request $request ){

        $appointment = New Appointments;
        $events = new Events;

        if ( Auth::id() ){
            $appointment->userId = Auth::user()->id;            
            $appointment->name = $request->name;
            $appointment->email = $request->email;
            $appointment->phone = $request->phone;
            $appointment->doctorId = $request->doctor;
            $appointment->date = $request->date;
            $appointment->status = "In Progress";
            $appointment->message = $request->message;
            $appointment->save();

            if ( $appointment->save() ) {
                $events->title = 'Appointment Posted';
                $events->date = $request->date;
                $events->appointmentId = $appointment->id;
                $events->userId = Auth::user()->id;
                $events->save();
            }

            return redirect()->back()->with( 'message', 'Request has been sent We will contact you soon..' );
        
        } else {
            return redirect()->back()->with( 'message', 'Please login to make an appointment' );
        }
    }

    public function approveAppointment( $id ){   
        $data = appointments::find( $id );
        $data->status = 'Approved';
        $data->save();

        return redirect()->back();
    }

    public function appointmentModal( $event_id ){
        $event = Events::find( $event_id );
        $appointment = Appointments::find( $event->appointmentId );
        $dateTime = new \DateTime( $appointment->date );
        $date = $dateTime->format('jS F Y');
        $doctorName = $appointment->doctorId;
        $doctorNumber = $appointment->phone;
        $viewUrl = url('appointment', ['appointment_id' => $appointment->id] );
        $data = [
            'date' => $date,
            'doctorName' => $doctorName,
            'doctorNumber' => $doctorNumber,
            'url' => $viewUrl
        ];

        return $data;
    }
}
