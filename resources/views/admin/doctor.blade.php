@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

    <div class="container my-5 pb-5">
        <h1 class="text-center wow fadeInUp">Dr. {{ $doctors->name }}</h1>
        <div class="appointment p-5 my-5">
            <div class="row mb-5 border-bottom">
                <h3 class="text-center w-100">Details</h3>
            </div>
            <div class="row">
                <div class="col-3">
                    <img src="/doctorsimages/{{ $doctors->image }}" alt="" class="img-fluid rounded">
                </div>
                <div class="col-9">
                    <div class="row mb-3">
                        <div class="col-6"><h5>Speciality</h5></div>
                        <div class="col-6">{{ $doctors->speciality }}</div>          
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><h5>Phone</h5></div>
                        <div class="col-6">{{ $doctors->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><h5>Room no.</h5></div>
                        <div class="col-6">{{ $doctors->room }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><h5>Date Added</h5></div>
                        <div class="col-6">{{ $doctors->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <a href="{{ route('edit-doctor', ['doctor_id' => $doctors->id] ) }}" class="d-block mx-auto btn btn-primary mt-3 wow zoomIn">Edit details</a>
                <a href="{{ route('delete-doctor', ['doctor_id' => $doctors->id] ) }}" class="d-block mx-auto btn btn-primary mt-3 wow zoomIn" onclick="confirm('Are you sure you want to delete ??')">Delete</a>
                <a class="d-block mx-auto btn btn-primary mt-3 wow zoomIn" href="{{ route('doctors') }}">Go Back</a>
            </div>
            
        </div>
    </div>

    @include('admin.footer')

@endsection