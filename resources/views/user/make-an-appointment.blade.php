@extends('layouts.app')
@section('title', '| Make an appointment')
@section('content')

  
  @include('partials.navbar')

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <form class="main-form" action="{{route('appointments')}}" method="POST" enctype="multipart/form-data">
      
      @if(session()->has('message'))
          <div class="alert alert-success text-center alert-dismissible" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
          </div>
      @endif
      
      @csrf
        <div class="row mt-5">

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" class="form-control" name="name" required placeholder="Full name">
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" class="form-control" name="email" required placeholder="Email address..">
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" class="form-control" name="date" required>
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="doctor" id="departement" class="custom-select" required>
              <option value="">--Select Doctor--</option>

              @foreach( $doctors as $doctor )

              <option value="{{ $doctor->name }} ">{{ $doctor->name }} ({{ $doctor->speciality }})</option>

              @endforeach
        
            </select>
          </div>

          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="number" class="form-control" name="phone" required placeholder="Number..">
          </div>

          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" rows="6" name="" required placeholder="Enter message.."></textarea>
          </div>

        </div>

        <button type="submit" class="btn btn-primary mt-3 wow zoomIn d-block mx-auto">Submit Request</button>
      </form>
    </div>
  </div> <!-- .page-section -->


  @include('partials.footer')
  
@endsection
