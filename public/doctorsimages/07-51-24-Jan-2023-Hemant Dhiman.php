@extends('layouts.app')

@section('header')
    @include('partials.header')
    @include('partials.navlogged')
@endsection

@section('content')

    @include('partials.sitetitle', ['siteTitle' => 'FIND SHIFT'])


    <section class='wrap'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-3 col-xl-2'></div>
                <div class='col-md ps-md-4'>
                    <h2 class='ps-4 text-uppercase'>UPCOMING SHIFTS</h2>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-3 col-xl-2'>
                    <div class='img-dog d-none d-md-block'>
                        <img src='{{ asset('images/dog-gray.svg') }}' alt='' class='img-fluid' />
                    </div>
                </div>
                <form action='' class='col-md ps-md-4'>
                    <div class='content-wrap shadow-sm'>
                        <div class='align-items-center d-flex heading-calendarview justify-content-between p-4'>
                            {{-- <div class='align-items-center d-flex form-check mb-0 p-0'>
                                <input class='form-check-input m-0' type='checkbox' id='receivealerts' defaultChecked />
                                <label class='form-check-label ms-2' htmlFor='receivealerts'>
                                    Receive Alerts
                                </label>
                            </div> --}}
                            <div class='align-items-center d-flex viewcalendarchange'>
                                <div class='align-items-center d-flex daily switch-button' id="switch-to-daily">
                                    Switch to Daily View
                                    <div class='align-items-center d-flex icon justify-content-center ms-2'>
                                        <i class='bi bi-calendar3'></i>
                                    </div>
                                </div>
                                <div class='align-items-center d-none monthly switch-button' id="switch-to-monthly">
                                    Switch to Monthly View
                                    <div class='align-items-center d-flex icon justify-content-center ms-2'>
                                        <i class='bi bi-calendar3'></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class='job-filter-form p-4'>
                            <div class='row'>
                                <div class='col-md-auto'>
                                    <h2>FILTER BY</h2>
                                </div>
                                <div class='col-md'>
                                    <div class='row mb-2 mb-md-4'>
                                        <label htmlFor='keyword' class='col-lg-2 col-form-label text-lg-end'>
                                            Keyword:
                                        </label>
                                        <div class='col-lg-8'>
                                            <input type='text' class='form-control' id='keyword' />
                                        </div>
                                    </div>
                                    <div class='row mb-2 mb-md-4'>
                                        <label htmlFor='practicetype' class='col-lg-2 col-form-label text-lg-end'>
                                            Practice Type:
                                        </label>
                                        <div class='col-lg-8'>
                                            <select class='form-select' id='practicetype' name="practice">
                                                <option value="">Select Practice Type</option>
                                                @if (!empty($practices))
                                                    @foreach ($practices as $key => $practice)
                                                        <option value="{{ $key }}">{{ $practice }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class='row mb-2 mb-md-4'>
                                        <label htmlFor='patient_types' class='col-lg-2 col-form-label text-lg-end'>
                                            Types of Patient Seen:
                                        </label>
                                        <div class='col-lg-8'>
                                            <select class='form-select' id='patient_types' name="patient_types">
                                                <option value="">Select Patient Type</option>
                                                @if (!empty($patient_types))
                                                    @foreach ($patient_types as $key => $type)
                                                        <option value="{{ $key }}">{{ $type }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class='row mb-2 mb-md-4'>
                                        <label htmlFor='distance' class='col-lg-2 col-form-label text-lg-end'>
                                            Distance:
                                        </label>
                                        <div class='col-lg-8'>
                                            <select class='form-select' id='distance'>
                                                <option></option>
                                                <option value='10'>10 miles</option>
                                                <option value='25'>25 miles</option>
                                                <option value='50'>50 miles</option>
                                                <option value='100'>100 miles</option>
                                                <option value='200'>200 miles</option>
                                                <option value='500'>500 miles</option>
                                                <option value='1000'>1000 miles</option>
                                            </select>
                                        </div>
                                       {{-- <div class='col-lg-auto pt-lg-2'>
                                            <a href='{{ route('veterinarians.settings.main') }}'>Edit your settings</a>
                                        </div> --}}
                                    </div>
                                    {{-- <div class='row mb-4'>
                                        <label htmlFor='commitment' class='col-lg-2 col-form-label text-lg-end'>
                                            Commitment:
                                        </label>
                                        <div class='col-lg-8'>
                                            <select class='form-select' id='commitment'>
                                                <option></option>
                                                <option value='1'>One</option>
                                                <option value='2'>Two</option>
                                                <option value='3'>Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <label htmlFor='myschedule' class='col-lg-2 col-form-label text-lg-end'>
                                            My Schedule:
                                        </label>
                                        <div class='col-lg-8'>
                                            <select class='form-select' id='myschedule'>
                                                <option></option>
                                                <option value='1'>One</option>
                                                <option value='2'>Two</option>
                                                <option value='3'>Three</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div id="alert_empty_calendar">

                        </div>
                        <div class='calendarview'>
                            <div id="calendar"></div>
                            @if (!empty($passed_shift_date))
                                <input type="hidden" value="{{ $passed_shift_date }}" id="passed-date" />
                                <input type="hidden" value="{{ $passed_shift_id }}" id="passed-shift-id" />
                            @endif
                            {{-- <div class='align-items-end d-flex justify-content-end notation p-4'>
                            <h6 class='mb-0'>Key:</h6>
                            <div class='meta-key lightred'>unavailable</div>
                            <div class='meta-key lightblue'>scheduled</div>
                            <div class='meta-key lightorange'>reschedule</div>
                            <div class='meta-key lightgrey'>pending</div>
                        </div> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="bid-list">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="border-0 flex-column justify-content-center modal-header modal-header">
                    <h2 class="align-items-center d-flex modal-title" id="modal-shift-date">SHIFT DATE: Nov. 1, 2022</h2>
                    <h3 id="modal-shift-available">Available Shifts: 3</h3><button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-info px-4 pt-0 modal-body" id="bid-body">
                    <div class="bid-box d-flex justify-content-between mb-2 flex-wrap">
                        <div class="copy">
                            <p><a href="/">Providence Veterinary Care</a><br><a
                                    href="/">www.providencepet.org</a></p>
                            <ul class="mb-0 mt-2 nav">
                                <li class="mb-0 me-5">Shift hours: 8am-5pm</li>
                                <li class="mb-0">Flexible? YES</li>
                            </ul>
                        </div>
                        <div class="cta"><a class="bttn smaller d-inline-flex py-2 text-decoration-none px-4"
                                href="/bid-on-shift">BID</a></div>
                    </div>
                    <div class="bid-box d-flex justify-content-between mb-2 flex-wrap">
                        <div class="copy">
                            <p><a href="/">Sunset Animal Hospital</a><br><a
                                    href="/">www.sunsetanimalhospital.com</a></p>
                            <ul class="mb-0 mt-2 nav">
                                <li class="mb-0 me-5">Shift hours: 1pm-4pm</li>
                                <li class="mb-0">Flexible? N0</li>
                            </ul>
                        </div>
                        <div class="cta"><a href="/"
                                class="bttn smaller d-inline-flex py-2 text-decoration-none px-4">BID</a></div>
                    </div>
                    <div class="bid-box d-flex justify-content-between flex-wrap">
                        <div class="copy">
                            <p><a href="/">Cascade Family Pet Clinic</a><br><a
                                    href="/">www.cascadepetclinic.com</a></p>
                            <ul class="mb-0 mt-2 nav">
                                <li class="mb-0 me-5">Shift hours: 8am-10am</li>
                                <li class="mb-0">Flexible? YES</li>
                            </ul>
                        </div>
                        <div class="cta"><a href="/"
                                class="bttn smaller d-inline-flex py-2 text-decoration-none px-4">BID</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('scripts')
@endsection
