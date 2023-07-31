@extends('layouts.app')
@section('title', '| My appointments')
@section('content')

    <!-- partials -->
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
                <tr >
                    <th class="col-1">Serial No.</th>
                    <th class="col-1">Doctor Name</th>
                    <th class="col-2">Date</th>
                    <th class="col-1">Status</th>
                    <th class="col-1">View</th>
                    <th class="col-1">Cancel Appointment</th>
                </tr>
            </thead>

            <tbody>
                @php $sNo = 1 @endphp
                    @foreach( $appointments as $appointment )
                <tr>
                    <td class="col-1">{{ $sNo }}</td>
                    <td class="col-1">{{ $appointment->doctorId }}</td>
                    <td class="col-2">{{ date_format( date_create($appointment->date),"jS F Y") }}</td>
                    <td class="col-1 @if($appointment->status == 'Approved') text-success @elseif($appointment->status == 'Cancelled') text-danger @else text-primary @endif">
                        <b>{{ $appointment->status }}</b>
                    </td>
                    <td class="col-1">
                        <a href="{{ url('appointment', ['appointment_id' => $appointment->id] ) }}">
                            <img src="../assets/img/arrow.png" alt="" class="d-block mx-auto rot">
                        </a>
                    </td>
                    <td class="col-1">
                        <a onclick="confirm('Are you sure you want to cancel ??')" href="{{ route('cancel-appointment', ['appointment_id' => $appointment->id] ) }}">
                            <img src="../assets/img/cancel.png" alt="" class="d-block mx-auto hov">
                        </a>
                    </td>
                </tr>
                    @php  $sNo = $sNo + 1 @endphp
                @endforeach
            </tbody>
            @endif
        </table>

        <div class="calendar mb-5">
            <h1 class="text-center text-primary"></h1>
            <div id="calendar"></div>
        </div>

    </div>
  </div>

  @include('partials.footer')  

@include('partials.modal.event-modal')

@endsection
