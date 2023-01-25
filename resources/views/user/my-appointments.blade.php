@extends('layouts.app')
@section('title', '| My appointments')
@section('content')

    <!-- partials -->
  @include('partials.topbar')

  @include('partials.navbar')

  <div class="container mt-5">
    <h1 class="text-center wow fadeInUp">My Appointments</h1>
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
                    <td colspan="6" class="py-4 ">You have no appointments</td>
                </tr>
                <tr>
                    <td colspan="6"><a href="{{ route('make-appointment') }}">Make an appointment</a></td>
                </tr>
            @else
            <thead>
                <th>Serial No.</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>View</th>
                <th>Cancel Appointment</th>
            </thead>

            <tbody>
                @php $sNo = 1 @endphp
                @foreach( $appointments as $appointment )
                <tr>
                    <td class="col-1">{{ $sNo }}</td>
                    <td class="col-2">{{ $appointment->doctorId }}</td>
                    <td class="col-2">{{ $appointment->date }}</td>
                    <td class="col-2 text-info">{{ $appointment->status }}</td>
                    <td class="col-1">
                        <a href="{{ url('appointment', ['appointment_id' => $appointment->id] ) }}">
                            <img src="../assets/img/arrow.png" alt="" class="d-block mx-auto rot">
                        </a>
                    </td>
                    <td class="col-1">
                        <a href="{{ route('cancel-appointment', ['appointment_id' => $appointment->id] ) }}">
                            <img src="../assets/img/cancel.png" alt="" class="d-block mx-auto">
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

  @include('partials.footer')  

@endsection
