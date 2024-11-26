<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PetPlanController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Auth::routes(['login' => false]);

Route::get('/dashboard', function () {
    $appointmentCount = Appointments::where('status', 0)->where('appointment_date', '>=', now())->count();
    $finishedAppointments = Appointments::where('status', 2)->where('updated_at', now())->count();
    $appointmentRequests = Appointments::where('status', null)->count();
    $petCount = Pets::count();
    return view('dashboard', ['appointmentCount' => $appointmentCount, 'finishedAppointments' => $finishedAppointments, 'petCount' => $petCount, 'appointmentRequests' => $appointmentRequests]);
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

    //sub routes Pet Medical Records

    //    Route::get('/record', function () {
    //        return view('pets.record');
    //    });
    Route::get('/petinfo/{id}/soap', [SoapController::class, 'index'])->name('soap.index');
    Route::get('/petinfo/{id}/soap/create', [SoapController::class, 'create'])->name('soap.create');
    Route::get('/petinfo/{id}/soap/view/{recordID}', [SoapController::class, 'show'])->name('soap.view');
    Route::post('petinfo/{id}/soap/add', [SoapController::class, 'store'])->name('soap.add');
    Route::post('/petinfo/{id}/soap/update/{recordID}', [SoapController::class, 'update'])->name('soap.update');
    Route::get('/petinfo/{pets}', [PetsController::class, 'show'])->name('pets.show');

    // sub routes Pet Plan
    Route::post('/soap/plan/{recordID}/addservice', [PetPlanController::class, 'store'])->name('plan.store');
    Route::post('/soap/plan/{recordID}/{id}/update', [PetPlanController::class, 'update'])->name('plan.update');
    Route::get('/soap/plan/{recordID}/{id}/delete', [PetPlanController::class, 'destroy'])->name('plan.delete');


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
    Route::get('viewappointments/{id}', [AppointmentsController::class, 'view'])->name('appointments.view');
    Route::get('/todayappointments', function () {
        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();

        return view('appointments.today', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets]);
    })->name('appointments.today');
    Route::get('/finishedappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();

        return view('appointments.completed', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments,  "vets" => $vets]);
    })->name('appointments.finished');
    Route::get('/pendingappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();

        return view('appointments.request', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments , "vets" => $vets]);
    })->name('appointments.pending');
    Route::get('/cancelledappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();
        return view('appointments.cancelled', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments , "vets" => $vets]);


    })->name('appointments.cancelled');

    Route::get('/viewappointments/{id}/done', [AppointmentsController::class, 'appointmentDone'])->name('appointments.done');
    Route::get('/viewappointments/{id}/cancell', [AppointmentsController::class, 'appointmentCancel'])->name('appointments.cancel');
    Route::get('/viewappointments/{id}/schedule', [AppointmentsController::class, 'appointmentSchedule'])->name('appointments.schedule');


    Route::get('/manageschedules', function () {
        return view('schedule.calendar');
    });

    // Pet Owners
    Route::get('/manageowners', [ClientsController::class, 'index'])->name('owners.index');
    Route::get('/addowner', function () {
        return view('owners.add');
    });
    Route::post('/profileowner/add', [ClientsController::class, 'store'])->name('owners.add');
    Route::get('/profileowner/{id}', [ClientsController::class, 'show'])->name('owners.show');
    Route::post('/profileowner/{id}', [ClientsController::class, 'update'])->name('owners.update');
    Route::post('/profileowner/{id}/disable', [ClientsController::class, 'disable'])->name('owners.disable');

    // POS Routes

    Route::get('/pos', [POSController::class, 'index'])->name('pos');
    Route::post('submit-transaction', [POSController::class, 'store'])->name('pos.pay');
    // Inventory Routes

    //products Sub Routes
    Route::get('/products', [ProductsController::class, 'index'])->name("products.index");
    Route::post('/products/addStocks/{id}', [ProductsController::class, 'addStocks'])->name("products.addStocks");
    Route::post('/products/add', [ProductsController::class, 'store'])->name("products.store");
    Route::post('/products/update/{id}', [ProductsController::class, 'update'])->name("products.update");
    Route::get('/products/{id}', [ProductsController::class, 'destroy'])->name("products.delete");

    //categories Sub Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name("categories.index");
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name("categories.delete");
    Route::post('/categories/add', [CategoryController::class, 'store'])->name("categories.add");
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name("categories.update");

    //suppliers Sub Routes
    Route::get('/suppliers', [SupplierController::class, 'index'])->name("suppliers.index");
    Route::post('/suppliers/add', [SupplierController::class, 'add'])->name("suppliers.add");
    Route::post('/suppliers/update/{id}', [SupplierController::class, 'update'])->name("suppliers.update");
    Route::get('/suppliers/{id}', [SupplierController::class, 'delete'])->name("suppliers.delete");

    //units Sub Routes
    Route::get('/units', [UnitController::class, 'index'])->name("units.index");
    Route::post('/units/add', [UnitController::class, 'store'])->name("units.add");
    Route::post('/units/update/{id}', [UnitController::class, 'update'])->name("units.update");
    Route::get('/units/{id}', [UnitController::class, 'destroy'])->name("units.delete");

    // User Management
    // Admin
    Route::get('/um/admin',  [AdminController::class, 'index'])->name("admin.manage");
    Route::get('/um/admin/add', function () {
        return view('user_management.admins.add');
    });
    Route::post('/um/admin/add', [AdminController::class, 'store'])->name("admin.add");
    Route::get('/um/admin/profile/{id}', [AdminController::class, 'show'])->name("admin.profile");
    Route::get('/um/admin/profile/{id}/options', [AdminController::class, 'edit'])->name('admin.profile.options');

    // Pet Owner
    Route::get('/um/client', [ClientsController::class, 'index'])->name("clients.index");
    Route::get('/um/client/add', function () {
        return view('user_management.pet_owners.add');
    });
    Route::get('/um/client/profile', function () {
        return view('user_management.pet_owners.profile');
    });
    Route::get('/um/client/profile/options', function () {
        return view('user_management.pet_owners.options');
    });

    // Staff
    Route::get('/um/staff', [StaffController::class, "index"])->name("staffs.index");
    Route::get('/um/staff/add', function () {
        return view('user_management.staffs.add');
    });
    Route::post('/um/staff/add', [StaffController::class, "store"])->name("staffs.add");
    Route::get('/um/staff/profile/{id}', [StaffController::class, "show"])->name("staffs.profile");
    Route::get('/um/staff/profile/{id}/options', [StaffController::class, "edit"])->name("staffs.options");

    Route::get('/profileowner/umsettings', function () {
        return view('owners.options');
    });

    Route::get('/print/sales', function () {
        return view('printable.sales');
    });

    // billing section
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
    Route::get('/billing/add', [BillingController::class, 'create'])->name('billing.add');
    Route::post('/billing/add', [BillingController::class, 'store'])->name('billing.store');
    Route::get('/billing/services', [ServicesController::class, 'index'])->name('billing.services');

    Route::post('/billing/services/add', [ServicesController::class, 'store'])->name("billing.services.add");

    Route::get('/billing/view', [BillingController::class, 'show'])->name('billing.view');
    Route::post('/billing/view/addPayment', [BillingController::class, 'addPayment'])->name('billing.addPayment');
    Route::get('/billing/print', [BillingController::class , 'print'])->name('billing.print');
});



// Portal Section
Route::get('/portal/login', function () {
    return view('portal.auth.login');
})->name("portal.login");
Route::get('/portal/register', function () {
    return view('portal.auth.register');
})->name(name: "portal.register");

Route::middleware('auth')->group(function () {
    Route::get('/portal/dashboard', [PortalController::class, 'index'])->name(name: "portal.dashboard");

    Route::get('/portal/mypets', [PortalController::class, 'myPets'])->name(name: "portal.mypets");

    Route::get('/portal/mypets/register', function () {
        return view('portal.main.pets.add');
    })->name(name: "portal.mypets.register");
    Route::post('/portal/mypets/add', [PortalController::class, 'addMyPet'])->name(name: "portal.mypets.add");
    Route::get('/portal/mypets/view', [PortalController::class, 'viewMyPet'])->name(name: "portal.mypets.view");
    Route::get('/portal/mypets/edit', [PortalController::class, 'editMyPet'])->name(name: "portal.mypets.edit");
    Route::post('/portal/mypets/update', [PortalController::class, 'updateMyPet'])->name(name: "portal.mypets.update");

    Route::get('/portal/appointments', [PortalController::class, 'myAppointments'])->name(name: "portal.appointments");
    Route::post('/portal/appoinments/add', [PortalController::class, 'addMyAppointment'])->name(name: "portal.appointments.add");
    Route::get('/portal/appointments/view', [PortalController::class, 'viewMyAppointments'])->name(name: "portal.appointments.view");

    Route::get('/portal/profile', [PortalController::class, 'profile'])->name(name: "portal.profile");
});




require __DIR__ . '/auth.php';
