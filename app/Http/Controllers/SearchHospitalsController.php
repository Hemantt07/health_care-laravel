<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hospitals;

class SearchHospitalsController extends Controller
{
    function searchHospitals(Request $req) {
        $lat = $req->lat;
        $lng = $req->lng;

        $hospitals = hospitals::whereBetween( 'lat', [$lat-0.2, $lat+0.2] )->whereBetween( 'lng ', [$lng-0.2, $lng+0.2] )->get();

        return $hospitals;
    }
}
