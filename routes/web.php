<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\ProfileController;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pets;
use App\Models\Appointments;

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
    Route::get('/addpet', [PetsController::class, 'create'])->name('pet.create');
    Route::get('/managepet', [PetsController::class, 'index'])->name('pet.index');
    Route::get('/profilepet/{pets}', [PetsController::class, 'show'])->name('pets.show');
    Route::get('/editpet/{pets}', [PetsController::class, 'edit'])->name('pets.edit');
    Route::put('/editpet/{pets}', [PetsController::class, 'update'])->name('pets.update');


Route::post('/pets/store', [PetsController::class, 'store'])->name('pets.store');


    // Doctors
    Route::get('/managedoctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('/adddoctor', [DoctorController::class, 'store'])->name('doctor.add');
    Route::get('/adddoctor', function () {
        return view('doctors.add');
    });
    Route::get('/profiledoctor/{id}', [DoctorController::class, 'showProfile'])->name('doctor.profile');

    Route::put('/profiledoctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');

    Route::get('/securitydoctor/{id}', function (string $id) {

        $user = User::with('doctor')->find($id);

        // If the user or doctor information is not found, handle it accordingly
        if (!$user || !$user->doctor) {
            // Handle the case where the user or doctor is not found
            // For example, return a 404 error or redirect the user
            abort(404, 'User or Doctor not found');
        }

        // Pass the combined user and doctor information to the view
        return view('doctors.security', ['doctor' => $user]);
    })->name('doctor.security');


    // Update the password
    Route::put('/securitydoctor/{id}', function (Request $request, $id) {

        // Find the doctor by ID
        $doctor = User::findOrFail($id);


        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $doctor->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        // Update the password
        $doctor->password = Hash::make($request->new_password);
        $doctor->save();

        // Redirect back with a success message
        return back()->with('success', 'Password updated successfully.');
    })->name('doctor.updateSecurity');




    Route::get('/adminsettingsdoctor/{id}', function (string $id) {

        $user = User::with('doctor')->find($id);

        // If the user or doctor information is not found, handle it accordingly
        if (!$user || !$user->doctor) {
            // Handle the case where the user or doctor is not found
            // For example, return a 404 error or redirect the user
            abort(404, 'User or Doctor not found');
        }

        // Pass the combined user and doctor information to the view
        return view('doctors.admin', ['doctor' => $user]);
    })->name('doctor.admin');

    Route::put('/adminsettingsdoctor/{id}', function (Request $request, $id) {
        $doctor = User::findOrFail($id);

        $doctor->role = $request->role;
        $doctor->save();


        // Redirect back with a success message
        return back()->with('success', 'Password updated successfully.');
    })->name('doctor.updateAdmin');

    // Appointments
    Route::get('/manageappointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::post('addappontments', [AppointmentsController::class, 'store'])->name('appointments.add');
    Route::get('viewappointments/{id}',[AppointmentsController::class, 'view'])->name('appointments.view');
    Route::get('/todayappointments', function () {
        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        return view('appointments.today', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments]);
    });
    Route::get('/finishedappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        return view('appointments.completed', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments]);
    });
    Route::get('/pendingappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        return view('appointments.request', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments]);
    });
    Route::get('/cancelledappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        return view('appointments.cancelled', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments]);
    });

});



require __DIR__ . '/auth.php';
