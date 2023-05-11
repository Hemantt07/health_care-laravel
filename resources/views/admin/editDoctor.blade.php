@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

<div class="container-fluid border border-bottom-0">
  <h3 class="text-center my-4">Edit Doctor's details</h3>
  <div class="add-doctors-form mx-auto my-5">

  @if(session()->has('message'))

    <div class="alert alert-success text-center alert-dismissible" role="alert">
      {{ session()->get('message') }}
      <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
    </div>

  @endif

  <form action="{{ route('edit-doctors-form', ['doctor_id' => $doctor->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-3 mt-4">
            <div class="mb-2">
                <img src="/doctorsimages/{{ $doctor->image }}" alt="">
            </div>
            <div class="mb-3">
                <input class="d-none" type="file" accept="image/*" name="file" id="formFile">
                <label for="formFile" class="form-label upload-photo">Upload photo</label>
            </div>
        </div>  
        <div class="col-9">
            <div class="form-group">
                <label for="name">Doctor Name</label>
                <input required type="text" class="form-control" name="name" value="{{ $doctor->name }}" placeholder="Enter name..">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input required type="number" class="form-control" name="phone" value="{{ $doctor->phone }}" placeholder="Enter phone number..">
            </div>

            <div class="form-group">
                <label for="room">Room No.</label>
                <input required type="number" class="form-control" name="room" value="{{ $doctor->room }}" placeholder="Enter room no.">
            </div>

            <div class="form-group">
                <label for="speciality">Speciality</label>
                <select class="form-control" name="speciality" required>
                <option >--Select--</option>
                <option value="Skin" @if( $doctor->speciality == 'Skin' ) selected @endif >Skin</option>
                <option value="Chest" @if( $doctor->speciality == 'Chest' ) selected @endif >Chest</option>
                <option value="Eyes" @if( $doctor->speciality == 'Eyes' ) selected @endif >Eyes</option>
                <option value="Ear" @if( $doctor->speciality == 'Ear' ) selected @endif >Ear</option>
                <option value="Legs" @if( $doctor->speciality == 'Legs' ) selected @endif >Legs</option>
                </select>
            </div>
        </div>
      </div>
      <div class="row mt-5">
        <button type="submit" class="d-block mx-auto btn btn-primary mt-3 wow zoomIn">Update</button>
        <a class="d-block mx-auto btn btn-primary mt-3 wow zoomIn" href="{{ route('doctors') }}">Go Back</a>
      </div>
    </form>

</div>
  </div>
</div>

  
@include('admin.footer')

@endsection