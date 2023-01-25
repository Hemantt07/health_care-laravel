@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

<div class="container-fluid border border-bottom-0">
  <h3 class="text-center my-4">Admin Panel</h3>
  <div class="add-doctors-form w-50 mx-auto my-5" >

  @if(session()->has('message'))

    <div class="alert alert-success text-center alert-dismissible" role="alert">
      {{ session()->get('message') }}
      <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
    </div>

  @endif

  <form action="{{ route('add-doctors-form') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="name">Doctor Name</label>
        <input required type="text" class="form-control" name="name" placeholder="Enter name..">
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input required type="number" class="form-control" name="phone" placeholder="Enter phone number..">
      </div>

      <div class="form-group">
        <label for="room">Room No.</label>
        <input required type="number" class="form-control" name="room" placeholder="Enter room no.">
      </div>

      <div class="form-group">
        <label for="speciality">Speciality</label>
        <select class="form-control" name="speciality" required>
          <option >--Select--</option>
          <option value="Skin">Skin</option>
          <option value="Chest">Chest</option>
          <option value="Eyes">Eyes</option>
          <option value="Ear">Ear</option>
          <option value="Legs">Legs</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="formFile" class="form-label">Doctor's Photo</label>
        <input required class="form-control" type="file" name="file" id="formFile">
      </div>

      <button type="submit" class="btn btn-primary mx-auto d-block">Add</button>
    </form>

  </div>
</div>

@endsection