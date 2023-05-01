<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\mailController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointments;
use App\Http\Mail\RejectionMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User

Route::get('/send', [mailController::class,'index']);

Route::get('/', [HomeController::class,'index']);

Route::get('/home', [HomeController::class,'redirect']);

Route::post('/appointments', [AdminController::class,'appointments'])->name('appointments');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
  
Route::get( '/about', [ PageController::class, 'about' ] )->name('about-page');

Route::get('/make-appointment', [HomeController::class,'make_appointment'])->name('make-appointment');

Route::get( '/doctors', [ PageController::class, 'doctors' ] )->name('doctors');

Route::get( '/my-appointments', [ PageController::class, 'myAppointments' ] )->name('my-appointments');

Route::get( '/hospitals', [ PageController::class, 'findHospitals' ] )->name('find-hospitals');

Route::get( '/appointment/{appointment_id}', [ PageController::class, 'appointment' ] )->name('appointment');

Route::get( '/user/profile', [ PageController::class, 'profile' ] )->name('profile');

Route::get( 'cancel/{appointment_id}',[ HomeController::class, 'cancelAppointment' ] )->name('cancel-appointment');

Route::post( '/full-calender/action',[ FullCalendarController::class, 'action' ] );

// Admin routes
 
Route::get('admin/add_doctors', [AdminController::class,'add_view'])->name('add-view');

Route::post('admin/add_doctors_form', [AdminController::class,'store_doctors'])->name('add-doctors-form');

Route::get( 'admin/doctor/{doctor_id}', [ AdminController::class, 'showDoctor' ] )->name('showdoctor');

Route::get( 'approve/{appointment_id}',[ AdminController::class, 'approveAppointment' ] )->name('approve-appointment');

Route::get( 'admin/edit-doctor-form/{doctor_id}',[ AdminController::class, 'editDoctorForm' ] )->name('edit-doctor');

Route::get( 'delete/{doctor_id}',[ AdminController::class, 'deleteDoctor' ] )->name('delete-doctor');

Route::post('edit_doctors/{doctor_id}', [AdminController::class,'editDoctor'])->name('edit-doctors-form');


