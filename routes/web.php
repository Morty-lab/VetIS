<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test', function () {

    $response = "test suceeded";

    return $response;
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Pets
Route::get('/addpet', function () {
    return view('pets.add');
});
Route::get('/managepet', function () {
    return view('pets.manage');
});
Route::get('/profilepet', function () {
    return view('pets.profile');
});
Route::get('/editpet', function () {
    return view('pets.edit');
});

// Doctors
Route::get('/managedoctor', function () {
    return view('doctors.manage');
});
Route::get('/adddoctor', function () {
    return view('doctors.add');
});
Route::get('/profiledoctor', function () {
    return view('doctors.profile');
});
Route::get('/securitydoctor', function () {
    return view('doctors.security');
});
Route::get('/adminsettingsdoctor', function () {
    return view('doctors.admin');
});

// Appointments
Route::get('/manageappointments', function () {
    return view('appointments.manage');
});
Route::get('/viewappointments', function () {
    return view('appointments.view');
});
Route::get('/todayappointments', function () {
    return view('appointments.today');
});
Route::get('/finishedappointments', function () {
    return view('appointments.completed');
});
Route::get('/pendingappointments', function () {
    return view('appointments.request');
});
Route::get('/cancelledappointments', function () {
    return view('appointments.cancelled');
});


require __DIR__ . '/auth.php';
