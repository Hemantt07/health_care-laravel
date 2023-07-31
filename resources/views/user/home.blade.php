@extends('layouts.app')
@section('title', '| Home')
@section('content')

  
  @include('partials.navbar')
  <div class="page-section pb-0">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 py-3 wow fadeInUp">
            <h1 class="mb-3">Welcome to <b class="text-primary">Health</b>-<b>Care</b></h1>
            <p class="text-grey mb-4"><b>"Health Care"</b> is a comprehensive hospital web application designed to streamline patient management & appointment scheduling. With user-friendly interfaces, it allows patients to book appointments online and receive personalized healthcare services. The app also enables healthcare providers to efficiently manage patient data, coordinate care, and enhance communication among medical staff, ultimately improving the overall healthcare experience !</p>
            <a href="about.html" class="btn btn-primary">Learn More</a>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
            <div class="img-place custom-img-1">
              <img src="../assets/img/bg-doctor.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end section -->

  @include('partials.doctors')

  @include('partials.appointment-link')

  @include('partials.footer')
  
@endsection

