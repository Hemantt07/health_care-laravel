@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

    <div class="container my-5 pb-5">
        <h1 class="text-center wow fadeInUp">Appointment<p style="font-size:25px" class="@if($appointment->first()->status == 'Approved') text-success @elseif($appointment->first()->status == 'Cancelled') text-danger @else text-primary @endif">( {{$appointment->first()->status}} )</p></h1>
        <div class="appointment p-5 my-5">
            <div class="row mb-3">
                <div class="col-4"><h5>Doctor</h5></div>
                <div class="col-8">{{$appointment->first()->doctorId}}</div>          
            </div>
            <div class="row mb-3">
                <div class="col-4"><h5>Date</h5></div>
                <div class="col-8">{{$appointment->first()->date}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4"><h5>Message</h5></div>
                <div class="col-8">{{$appointment->first()->message}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4"><h5>Date Requested</h5></div>
                <div class="col-8">{{$appointment->first()->created_at}}</div>
            </div>
            <div class="row mt-5">
                @if ( $appointment->first()->status == 'In Progress' )
                    <a href="{{ route('cancel-appointment', ['appointment_id' => $appointment->first()->id] ) }}" class="d-block mx-auto btn btn-primary mt-3 wow zoomIn">Approve appointment</a>
                    <a href="{{ route('cancel-appointment', ['appointment_id' => $appointment->first()->id] ) }}" class="d-block mx-auto btn btn-primary mt-3 wow zoomIn">Cancel appointment</a>
                @endif
                    <a class="d-block mx-auto btn btn-primary mt-3 wow zoomIn" href="{{ route('my-appointments') }}">Go Back</a>
            </div>
        </div>
    </div>

    @include('admin.footer')

@endsection