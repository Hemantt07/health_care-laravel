@extends('layouts.app')
@section('title', '| Admin')
@section('content')

@include('admin.navbar')

<div class="container mt-5" id="container">
    <h1 class="text-center wow fadeInUp">Appointments</h1>
    <div class="row">
        @if(session()->has('message'))
          <div class="mt-5 col-12 alert alert-danger text-danger alert-dismissible" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
          </div>
        @endif

        <table class="table my-5 table-appointment">
            @if ( count($appointments) == 0 )
                <tr class="">
                    <td colspan="6" class="py-4 ">No appointments requested</td>
                </tr>
            @else
            <thead>
                <th>Serial No.</th>
                <th>Customer</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>View</th>
                <th>Approve</th>
                <th>Cancel</th>
            </thead>

            <tbody>
                @php $sNo = 1 @endphp
                @foreach( $appointments as $appointment )
                <tr>
                    <td class="col-1">{{ $sNo }}</td>
                    <td class="col-1">{{ $appointment->name }}</td>
                    <td class="col-1">{{ $appointment->doctorId }}</td>
                    <td class="col-1">{{ $appointment->date }}</td>
                    <td class="col-1 @if($appointment->status == 'Approved') text-success @elseif($appointment->status == 'Cancelled') text-danger @else text-primary @endif">{{ $appointment->status }}</td>
                    <td class="col-1">
                        <a href="{{ url('appointment', ['appointment_id' => $appointment->id] ) }}">
                            <img src="../assets/img/arrow.png" alt="" class="d-block mx-auto rot">
                        </a>
                    </td>
                    @if ( $appointment->status == 'In Progress' )
                        <td class="col-1">
                            <a href="{{ url('approve', ['appointment_id' => $appointment->id] ) }}">
                                <img src="../assets/img/approve.png" alt="" class="d-block mx-auto hov">
                            </a>
                        </td>
                        <td class="col-1">
                            <a onclick="confirm('Are you sure you want to cancel ??')" href="{{ route('cancel-appointment', ['appointment_id' => $appointment->id] ) }}">
                                <img src="../assets/img/cancel.png" alt="" class="d-block mx-auto hov">
                            </a>
                        </td>
                    @elseif ( $appointment->status == 'Approved' )
                        <td colspan="2" class="col-2">
                            <b>Appointment has been approved</b>
                        </td>
                    @else
                        <td colspan="2" class="col-2">
                            <b>Appointment has been cancelled</b>
                        </td>
                    @endif
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