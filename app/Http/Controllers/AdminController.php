<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function add_view()
    {
        return view('admin.add-doctors');
    }

    function store_doctors(Request $req)
    {
        $doctor = New doctors;

        $image = $req->file;

        $imagename = $req->name . date("h-i-d-M-Y-").'.'. $image->getClientOriginalExtension();

        $req->file->move('doctorsimages', $imagename);

        $doctor->image = $imagename;

        $doctor->name = $req->name;

        $doctor->phone = $req->phone;

        $doctor->room = $req->room;

        $doctor->speciality = $req->speciality;

        $doctor->save();

        return redirect()->back()->with('message', 'Doctor added successfully');
    }

    function appointments( Request $request ){

        $appointments = New Appointments;

        if ( Auth::id() ){
            $appointments->userId = Auth::user()->id;            
            $appointments->name = $request->name;
            $appointments->email = $request->email;
            $appointments->phone = $request->phone;
            $appointments->doctorId = $request->doctor;
            $appointments->date = $request->date;
            $appointments->status = "In Progress";
            $appointments->message = $request->message;
            $appointments->save();

            return redirect()->back()->with( 'message', 'Request has been sent We will contact you soon..' );
        
        } else {
            return redirect()->back()->with( 'message', 'Please login to make an appointment' );
        }

    }
}
