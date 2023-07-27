<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Appointments;
use App\Models\Events;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function add_view(){
        if( Auth::id() ){
            if ( Auth::user()->usertype == 1 ){  
                return view('admin.add-doctors');
            } else {
                abort(404);
            }
        } else {
            return redirect()->back();
        }
    }

    public function store_doctors(Request $req){
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


    public function showDoctor( $id ){
        if( Auth::id() ) {
            if ( Auth::user()->usertype == 1 ) {  
                $doctors = doctors::find( $id );
            } else {
                abort(404);
            }
        } else {
            return redirect()->back();
        }

        return view( 'admin.doctor', compact( 'doctors' ) );
    }

    public function deleteDoctor( $id ) {
        $doctor = doctors::find( $id );
        $doctor->delete();

        return redirect( 'doctors' )->with( 'message', 'Doctor details has been deleted' );
    }

    public function editDoctorForm( $id ){
        $doctor = doctors::find( $id );
        return view( 'admin.editDoctor' , compact( 'doctor' ) );
    }

    public function editDoctor( Request $req , $id ) {
        $doctor = doctors::find( $id );
        $image = $req->file;

        if ( $image ) {
            $imagename = $req->name . date("h-i-d-M-Y-").'.'. $image->getClientOriginalExtension();
            $req->file->move('doctorsimages', $imagename);
            $doctor->image = $imagename;
        }

        $doctor->name = $req->name;
        $doctor->phone = $req->phone;
        $doctor->room = $req->room;
        $doctor->speciality = $req->speciality;
        $doctor->save();

        return redirect()->back()->with('message', 'Doctor details edited successfully');
    }
}
