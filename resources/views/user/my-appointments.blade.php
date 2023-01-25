@extends('layouts.app')
@section('title', '| My appointments')
@section('content')

    <!-- partials -->
  @include('partials.topbar')

  @include('partials.navbar')

  <div class="container mt-5">
    <h1 class="text-center wow fadeInUp">My Appointments</h1>
    <div class="row">

        <table class="table my-5 table-appointment">

            <thead>
                <th>Serial No.</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>View</th>
            </thead>

            <tbody>
                @php $sNo = 1 @endphp
                @foreach( $appointments as $appointment )
                <tr>
                    <td class="col-1">{{ $sNo }}</td>
                    <td class="col-2">
                            @foreach( $doctors as $doctor )
                                @if( $doctor->id == $appointment->doctorId )
                                    @php $doctorName = $doctor->name @endphp
                                @endif
                            @endforeach
                        {{ $doctorName }}
                    </td>
                    <td class="col-2">{{ $appointment->date }}</td>
                    <td class="col-2">{{ $appointment->status }}</td>
                    <td class="col-1">
                        <a href="#"><img src="../assets/img/arrow.png" alt="" class="d-block mx-auto rot"></a>
                    </td>
                </tr>
                @php  $sNo = $sNo + 1 @endphp
                @endforeach
            </tbody>

        </table>

    </div>
  </div>

  @include('partials.footer')  

@endsection
