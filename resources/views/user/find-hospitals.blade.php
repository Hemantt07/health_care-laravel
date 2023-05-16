@extends('layouts.app')
@section('title', '| Find Hospitals')
@section('content')

  @include('partials.navbar')

  <div class="container my-5">
    <h1 class="text-center wow mb-5">Find Hospitals</h1>

    <div class="row">
      <div class="col-md-4 map-form">
        {{-- Form --}}
        <form action="">

          <div class="row">
            <div class="col-12 mb-3">
              <input type="text" class="form-control" placeholder="Longitude" aria-label="Longitude">
            </div>

            <div class="col-12 mb-3">
              <input type="text" class="form-control" placeholder="Latitude" aria-label="Latitude">
            </div>

            <div class="col-12 mb-3">
              <select class="form-select form-control" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="mb-5 w-100">
              <button id="current">+</button>
            </div>

          </div>
        </form>
      </div>
      {{-- Map --}}
      <div class="col-md-8">
        <div id="map"></div>
      </div>
    </div>

  </div>
  
  @include('partials.footer')
  
@endsection