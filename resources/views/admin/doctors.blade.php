@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

<div class="container mt-5" id="container">
    <h1 class="text-center wow fadeInUp">Our Doctors</h1>
    <div class="row">
        @if(session()->has('message'))
          <div class="mt-5 col-12 alert alert-danger text-danger alert-dismissible" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
          </div>
        @endif

        <table class="table my-5 table-appointment">
            @if ( count($doctors) == 0 )
                <tr class="">
                    <td colspan="6" class="py-4 ">nothing here</td>
                </tr>
                <tr>
                    <td colspan="6"><a href="{{ route('make-appointment') }}">Add Doctor</a></td>
                </tr>
            @else
            <thead>
                <th>Serial No.</th>
                <th>Doctor Name</th>
                <th>Phone</th>
                <th>Speciality</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>

            <tbody>
                @php $sNo = 1 @endphp
                @foreach( $doctors as $doctor )
                <tr>
                    <td class="col-1">
                        <div class="row">
                            <div class="col-2">{{ $sNo }}</div>
                            <div class="col-9"><img src="./doctorsimages/{{ $doctor->image }}" alt="" class="img-fluid"></div>
                        </div>
                    </td>
                    <td class="col-1">Dr. {{ $doctor->name }}</td>
                    <td class="col-1">{{ $doctor->phone }}</td>
                    <td class="col-1">{{ $doctor->speciality }}</td>
                    <td class="col-1">
                        <a href="{{ route('showdoctor', ['doctor_id' => $doctor->id] ) }}">
                            <img src="../assets/img/arrow.png" alt="" class="d-block mx-auto rot">
                        </a>
                    </td>
                    <td class="col-1">
                        <a href="{{ route('edit-doctor', ['doctor_id' => $doctor->id] ) }}">
                            <img src="../assets/img/edit.png" alt="" class="d-block mx-auto hov">
                        </a>
                    </td>
                    <td class="col-1">
                        <a onclick="confirm('Are you sure you want to delete ??')" href="{{ route('delete-doctor', ['doctor_id' => $doctor->id] ) }}">
                            <img src="../assets/img/delete.png" alt="" class="d-block mx-auto hov">
                        </a>
                    </td>
                </tr>
                    @php  $sNo = $sNo + 1 @endphp
                @endforeach
            </tbody>
            @endif
        </table>

    </div>
  </div>

@include('admin.footer')

@endsection