@extends('layouts.app')
@section('title', '| Home')
@section('content')

  
  @include('partials.navbar')

    <div class="container mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13721.64498898121!2d76.6993680596352!3d30.706837169748656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390feff6924d7055%3A0x6f2d60fadafb0b2b!2sIVY%20Hospital%20Mohali!5e0!3m2!1sen!2sin!4v1675246149123!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div class="form">
            <div class="input-group my-3">
                <span class="input-group-text ">🌐</span>
                <input type="text" class="form-control" placeholder="Longitude" aria-label="Longitude">
                <span class="input-group-text">🌐</span>
                <input type="text" class="form-control" placeholder="Latitude" aria-label="Latitude">
            </div>
            <button type="submit" class="btn btn-primary mt-3 wow zoomIn d-block mx-auto">Search</button>
        </div>
    </div>
</div>

  @include('partials.footer')
  
@endsection
