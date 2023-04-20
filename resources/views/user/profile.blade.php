@extends('layouts.app')
@section('title', '| Profile')
@section('content')
  
@include('partials.navbar')

  <!-- partials -->

<div class="container my-5">
    <form class="profile">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control" id="staticEmail" value="email@example.com">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
        </div>
    </form>
</div>

  <!-- partial -->
@include('partials.footer')

@endsection