@extends('layouts.app')
@section('title', '| Profile')
@section('content')
  
@include('partials.navbar')

  <!-- partials -->

<div class="container user-profile  mb-5 ">

    <div class="row justify-content-end w-100">
        <a href="#" class="d-block edit-button mt-3">Edit</a>
    </div>
    <div class="p-5 row">

        <div class="col-md-4 align-items-center d-flex">
            <h1 class="wow fadeInUp animated">Your Profile</h1>
        </div>

        <div class="col-md-8">
            <div class="mb-3 row">
                <div class="col-6 title">Name :</div>
                <div class="col-6 title">{{ Auth::user()->name }}</div>          
            </div>
            <div class="mb-3 row">
                <div class="col-6 title">Email :</div>
                <div class="col-6 title">{{ Auth::user()->email }}</div>
            </div>
        </div>
       
    </div>
</div>

  <!-- partial -->
@include('partials.footer')

@endsection