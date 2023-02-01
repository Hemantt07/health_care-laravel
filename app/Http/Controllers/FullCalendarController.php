<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class FullCalendarController extends Controller
{

    public function action( Request $req )
    {
        if ( $req->ajax() ) {
            if ( $req->type == 'add' ) {
                $event = Event::create([
                    'title'     => $req->title,
                    'start'     => $req->start,
                    'end'       => $req->end
                ]);

                return response()->json( $event );
            }
        }
    }
}
