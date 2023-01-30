@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

  <div class="container-fluid border border-bottom-0" id="container">
      <h3 class="text-center my-4">Admin Panel</h3>
      <div class="container">
          <div class="row">
            <div class="col-4 mt-5">
              <h5 class="text-center text-primary">Add Doctors</h5>
              <div class="card-doctor my-0">
                <div class="header">
                  <img src="../assets/img/add.png" alt="" class="img-fluid mx-auto">
                  <div class="meta1 w-100">
                    <h6 class="text-center w-100 m-0"><a href="{{ route('add-view') }}" class="mx-5 py-3">Add Doctors</a></h6>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-4 mt-5">
              <h5 class="text-center text-primary">Appointments</h5>
              <div class="card-doctor my-0">
                  <div class="header">
                    <img src="../assets/img/appoint.jpeg" alt="" class="img-fluid mx-auto">
                    <div class="meta1 w-100">
                      <h6 class="text-center w-100 m-0"><a href="{{ route('my-appointments') }}" class="mx-5 py-3">Appointments</a></h6>
                    </div>
                  </div>
              </div>
            </div>

            <div class="col-4 mt-5">
                <h5 class="text-center text-primary">Doctors</h5>
                <div class="card-doctor my-0">
                    <div class="header">
                      <img src="../assets/img/bg-doctor.png" alt="" class="img-fluid mx-auto">
                      <div class="meta1 w-100">
                        <h6 class="text-center w-100 m-0"><a href="{{ route('doctors') }}" class="mx-5 py-3">Doctors</a></h6>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
              <img src="" alt="">
            </div>
          </div>
      </div>
  </div>

  
@include('admin.footer')
@endsection
