@extends('layouts.app')
@section('title', '| Doctors')
@section('page', 'Our Doctors')
@section('content')

  <!-- partials -->
  

  <!-- partials -->
  @include('partials.navbar')

  <!-- partials -->
  @include('partials.banner')

  <div class="page-section">
    <div class="container">
      <div class="row">
      @foreach( $doctors as $doctor )

        <div class="col-6 col-md-4">
          <div class="card-doctor">
            <div class="header">
              <img src="../doctorsimages/{{ $doctor->image }}" alt="">
              <div class="meta">
                <a href="tel:{{ $doctor->phone }}"><span class="mai-call"></span></a>
                <a href="https://wa.me/+91{{ $doctor->phone }}?text=Hi,
Can we please have a chat."  target="__blank">
                  <span class="mai-logo-whatsapp"></span>
                </a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. {{ $doctor->name }}</p>
              <span class="text-sm text-grey">{{ $doctor->speciality }}</span>
            </div>
          </div>
        </div>

      @endforeach
      </div>
    </div>
  </div>

  <!-- partials -->
  @include('partials.appointment-link')

  <!-- partial -->
  

  <!-- partial -->
  @include('partials.footer')
  
@endsection