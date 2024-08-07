<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;

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
    Route::get('/managedoctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('/adddoctor', [DoctorController::class, 'store'])->name('doctor.add');
    Route::get('/adddoctor', function () {
        return view('doctors.add');
    });
    Route::get('/profiledoctor/{id}', [DoctorController::class, 'showProfile'])->name('doctor.profile');

    Route::put('/profiledoctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');

    Route::get('/securitydoctor/{id}', function (string $id) {

        $doctor = Doctor::getDoctorById($id);
        return view('doctors.security', ['doctor' => $doctor]);
    })->name('doctor.security');
    Route::get('/adminsettingsdoctor/{id}', function (string $id) {

        $doctor = Doctor::getDoctorById($id);
        return view('doctors.admin', ['doctor' => $doctor]);
    })->name('doctor.admin');

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

    Route::get('/manageschedules', function () {
        return view('schedule.calendar');
    });

    // Pet Owners
    Route::get('/manageowners', function () {
        return view('owners.manage');
    });
    Route::get('/addowner', function () {
        return view('owners.add');
    });
    Route::get('/profileowner', function () {
        return view('owners.profile');
    });
    Route::get('/products', function () {
        return view('inventory.products');
    });
    Route::get('/categories', function () {
        return view('inventory.categories');
    });
    Route::get('/suppliers', function () {
        return view('inventory.suppliers');
    });
    Route::get('/units', function () {
        return view('inventory.units');
    });
    Route::get('/pos', function () {
        return view('pos.pos');
    });
});


require __DIR__ . '/auth.php';
