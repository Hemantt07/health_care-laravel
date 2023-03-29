<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\RejectionMail;

class mailController extends Controller
{
    public function index(){
        $data = [
            'body' => 'Your appointment has been canceled by the admin.'
        ];

        try {

            Mail::to('reshavdhiman67@gmail.com')->send(new RejectionMail([]));
            return response()->json(['Great check your Eamil']);
            
        } catch ( Exception $th ) {

            return response()->json(['Error : ']);

        }
    }
}
