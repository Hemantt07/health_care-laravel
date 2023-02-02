@extends('layouts.app')
@section('title', '| My appointments')
@section('content')

    <!-- partials -->
  

  @include('partials.navbar')

  <div class="container mt-5">

        <div class="calendar mb-5">
            <h1 class="text-center text-primary"></h1>
            <div id="calendar"></div>
        </div>

    </div>
  </div>

  @include('partials.footer')  

@endsection
