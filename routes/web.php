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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VaccinationController;
use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Pets;
use App\Models\Services;
use App\Models\TransactionModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('portal.login');
});

Route::get('/appointments/available-times', [AppointmentsController::class, 'getAvailableTimes'])->name('appointments.available-times');

Auth::routes(['login' => false]);

Route::get('/dashboard', function () {
    $today = Carbon::today();

    $appointments = Appointments::all();
    $todayCount = 0;
    foreach ($appointments as $appointment) {
    if (
    $appointment->status == 0 &&
    \Carbon\Carbon::parse($appointment->appointment_date)->isToday()
    ) {
    $todayCount++;
    } else {
    continue;
    }
    }


    // Count today's pending (status 0) appointments
    $todayCount = Appointments::where('status', 0)
        ->whereDate('appointment_date', $today)
        ->count();

    // Count today's finished (status 1) appointments
    $finishedCount = Appointments::where('status', 1)
        ->whereDate('updated_at', $today)
        ->count();

    // Count appointment requests with null status
    $appointmentRequests = Appointments::whereNull('status')->count();

    // Count all pets
    $petCount = Pets::count();

    // Fetch daily sales report
    $dailySales = TransactionModel::getDailySalesReport();

    return view('dashboard', compact(
        'todayCount',
        'finishedCount',
        'petCount',
        'appointmentRequests',
        'dailySales'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin,secretary'])->group(function () {
    //Pet Routes
    Route::get('/addpet', [PetsController::class, 'create'])->name('pet.create');
    Route::get('/managepet', [PetsController::class, 'index'])->name('pet.index');
    Route::get('/profilepet/{pets}', [PetsController::class, 'show'])->name('pets.show');
    Route::get('/editpet/{pets}', [PetsController::class, 'edit'])->name('pets.edit');
    Route::put('/editpet/{petID}', [PetsController::class, 'update'])->name('pets.update');
    Route::post('/pets/store', [PetsController::class, 'store'])->name('pets.store');
    Route::post('/pets/verify', [PetsController::class, 'verifyPet'])->name('pets.verify');
    Route::post('/pets/{id}/upload-photo', [PetsController::class, 'uploadPhoto'])->name('pets.uploadPhoto');

});
Route::middleware(['auth', 'role:admin,staff,veterinarian'])->group(function () {
    //Pet Routes
    Route::get('/managepet', [PetsController::class, 'index'])->name('pet.index');
    Route::get('/profilepet/{pets}', [PetsController::class, 'show'])->name('pets.show');
    Route::get('/editpet/{pets}', [PetsController::class, 'edit'])->name('pets.edit');
    Route::put('/editpet/{petID}', [PetsController::class, 'update'])->name('pets.update');
    Route::post('/pets/verify', [PetsController::class, 'verifyPet'])->name('pets.verify');
    Route::post('/pets/{id}/upload-photo', [PetsController::class, 'uploadPhoto'])->name('pets.uploadPhoto');

});


Route::middleware(['auth', 'role:admin,veterinarian,staff'])->group(function () {
    //Pet Vaccination
    Route::post('/pets/vaccination', [VaccinationController::class, 'store'])->name('vaccination.add');
    Route::post('/pets/vacciantion/update', [VaccinationController::class, 'update'])->name('vaccination.update');

    //Pet Records
    Route::get('/petinfo/{id}/soap', [SoapController::class, 'index'])->name('soap.index');
    Route::get('/petinfo/{id}/soap/create', [SoapController::class, 'create'])->name('soap.create');
    Route::get('/petinfo/{id}/soap/view/{recordID}', [SoapController::class, 'show'])->name('soap.view');
    Route::post('petinfo/soa p/add', [SoapController::class, 'store'])->name('soap.add');
    Route::post('/petinfo/{id}/soap/update/{recordID}', [SoapController::class, 'update'])->name('soap.update');
    Route::get('/petinfo/{pets}', [PetsController::class, 'show'])->name('pets.show');
    Route::get('/petinfo/soap/print', function () {
        return view('pets.forms.printRecord');
    })->name("soap.print");
});

//User Managemnt
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Doctors
    Route::get('/managedoctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('/adddoctor', [DoctorController::class, 'store'])->name('doctor.add');
    Route::get('/adddoctor', function () {
        return view('doctors.add');
    });
    Route::get('/profiledoctor/{id}', [DoctorController::class, 'showProfile'])->name('doctor.profile');

    Route::put('/profiledoctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');

    Route::put('/doctors/{id}/update-email', [DoctorController::class, 'updateEmail'])->name('doctor.update.email');

    Route::put('/doctors/{id}/reset-password', [DoctorController::class, 'resetPassword'])->name('doctor.resetpassword');

    Route::put('/doctors/{id}/disable-vet', [DoctorController::class, 'disableVet'])->name('doctor.disable');

    Route::put('/doctors/{id}/enable-vet', [DoctorController::class, 'enableVet'])->name('doctor.enable');

    Route::put('/doctors/{id}/upload-vet-image', [DoctorController::class, 'uploadVetPhoto'])->name('doctor.upload.photo');

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

    // Pet Owners
    Route::get('/manageowners', [ClientsController::class, 'index'])->name('owners.index');
    Route::get('/addowner', function () {
        return view('owners.add');
    });
    Route::post('/profileowner/add', [ClientsController::class, 'store'])->name('owners.add');
    Route::get('/profileowner/{id}', [ClientsController::class, 'show'])->name('owners.show');
    Route::post('/profileowner/{id}', [ClientsController::class, 'update'])->name('owners.update');
    Route::post('/profileowner/{id}/disable', [ClientsController::class, 'disable'])->name('owners.disable');

    // // Admin
    // Route::get('/um/admin', [AdminController::class, 'index'])->name("admin.manage");
    // Route::get('/um/admin/add', function () {
    //     return view('user_management.admins.add');
    // });
    // Route::post('/um/admin/add', [AdminController::class, 'store'])->name("admin.add");
    // Route::get('/um/admin/profile/{id}', [AdminController::class, 'show'])->name("admin.profile");
    // Route::get('/um/admin/profile/{id}/options', [AdminController::class, 'edit'])->name('admin.profile.options');
    // Route::get('/um/admin/update', function () {
    //     return view('user_management.admins.update');
    // })->name("admins.update");

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
    Route::post('/um/staff/update', [StaffController::class, 'update'])->name("staffs.update");
    Route::post('/um/staff/resetpassword', [StaffController::class, "resetPassword"])->name("staffs.resetpassword");
    Route::post('/um/staff/switchstatus', [StaffController::class, 'switchstatus'])->name("staffs.switchstatus");
    Route::get('/profileowner/umsettings', function () {
        return view('owners.options');
    });


});

//Appointments
Route::middleware(['auth', 'role:admin,secretary,veterinarian'])->group(function () {
    // Appointments
    Route::get('/manageappointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::post('addappontments', [AppointmentsController::class, 'store'])->name('appointments.add');
    Route::get('viewappointments/{id}', [AppointmentsController::class, 'view'])->name('appointments.view');
    Route::get('/todayappointments', function () {
        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();
        $services = Services::getAllServices();

        return view('appointments.today', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets, "services" => $services]);
    })->name('appointments.today');
    Route::get('/finishedappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $services = Services::getAllServices();
        $vets = Doctor::getAllDoctors();

        return view('appointments.completed', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets, "services" => $services]);
    })->name('appointments.finished');
    Route::get('/pendingappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();
        $services = Services::getAllServices();

        return view('appointments.request', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets, "services" => $services]);
    })->name('appointments.pending');
    Route::get('/cancelledappointments', function () {

        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->get();
        $vets = Doctor::getAllDoctors();
        $services = Services::getAllServices();

        return view('appointments.cancelled', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets, "services" => $services]);
    })->name('appointments.cancelled');

    Route::get('/viewappointments/{id}/done', [AppointmentsController::class, 'appointmentDone'])->name('appointments.done');
    Route::get('/viewappointments/{id}/cancell', [AppointmentsController::class, 'appointmentCancel'])->name('appointments.cancel');
    Route::get('/viewappointments/{id}/schedule', [AppointmentsController::class, 'appointmentSchedule'])->name('appointments.schedule');

    Route::post('/viewappointments/update', [AppointmentsController::class, 'update'])->name('appointments.update');
});

//POS and Inventory
Route::middleware(['auth', 'role:admin,cashier,staff'])->group(function () {
    // POS Routes

    Route::get('/pos', [POSController::class, 'index'])->name('pos');
    Route::post('submit-transaction', [POSController::class, 'store'])->name('pos.pay');
    // Inventory Routes

    //products Sub Routes
    Route::get('/products', [ProductsController::class, 'index'])->name("products.index");
    Route::post('/products/addStocks/{id}', [ProductsController::class, 'addStocks'])->name("products.addStocks");
    Route::post('/products/repackStocks', [ProductsController::class, 'repackStock'])->name("products.repackStocks");

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

    // billing section
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
    Route::get('/billing/add', [BillingController::class, 'create'])->name('billing.add');
    Route::post('/billing/add', [BillingController::class, 'store'])->name('billing.store');
    Route::get('/billing/services', [ServicesController::class, 'index'])->name('billing.services');

    Route::post('/billing/services/add', [ServicesController::class, 'store'])->name("billing.services.add");

    Route::get('/billing/view', [BillingController::class, 'show'])->name('billing.view');
    Route::post('/billing/view/addPayment', [BillingController::class, 'addPayment'])->name('billing.addPayment');
    Route::get('/billing/print', [BillingController::class, 'print'])->name('billing.print');

    //Printable sales
    Route::get('/print/sales', function () {
        return view('printable.sales');
    });

    //Reports
    Route::get('/reports', [ReportController::class, 'index'])->name("reports.index");
    Route::get('/reports/pos/', [ReportController::class, 'pos'])->name("reports.pos");
    Route::get('/reports/pos/daily-sales/print', [ReportController::class, 'printDaily'])->name("reports.pos.daily.reports");
    Route::get('/reports/pos/monthly-sales/print', [ReportController::class, 'printMonthly'])->name("reports.pos.monthly.reports");

    // Inventory Reports
    Route::get('/reports/inventory/', [ReportController::class, 'inventory'])->name("reports.inventory");
    Route::get('/reports/inventory/products-list/print', [ReportController::class, 'printProductList'])->name("reports.inventory.productsList");

    Route::get('/reports/inventory/item-stock/print', [ReportController::class, 'printStockList'])->name("reports.inventory.itemStock");

    Route::get('/reports/inventory/all-stock/print', [ReportController::class, 'printStockListAll'])->name("reports.inventory.allStockList");

    Route::get('/reports/inventory/low-stock/print', [ReportController::class, 'printLowStock'])->name("reports.inventory.lowStockList");
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        $user = User::where('id', Auth::id())->first();
        switch ($user->role) {
            case 'admin':
                $userInfo = \App\Models\Admin::where('user_id', $user->id)->first();
                break;
            case 'staff' || 'secretary' || 'cashier':
                $userInfo = \App\Models\Staff::where('user_id', $user->id)->first();
                break;
            case 'client':
                $userInfo = \App\Models\Clients::where('user_id', $user->id)->first();
                break;
            case 'veterinarian':
                $userInfo = \App\Models\Doctor::where('user_id', $user->id)->first();
                break;
        }

        return view('profile.view', ['user' => $user, 'userInfo' => $userInfo]);
    })->name("profile.view");
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/uploadPhoto/{id}', [AdminController::class, 'uploadPhoto'])->name('uploadPhoto');

    // sub routes Pet Plan
    Route::post('/soap/plan/{recordID}/addservice', [PetPlanController::class, 'store'])->name('plan.store');
    Route::post('/soap/plan/{recordID}/{id}/update', [PetPlanController::class, 'update'])->name('plan.update');
    Route::get('/soap/plan/{recordID}/{id}/delete', [PetPlanController::class, 'destroy'])->name('plan.delete');

    //Schedules
    Route::get('/manageschedules', [\App\Http\Controllers\CalendarController::class, 'index'])->name('schedules.index');
});


// Portal Section
Route::get('/portal/login', function () {
    return view('portal.auth.login');
})->name("portal.login");
Route::get('/portal/register', function () {
    return view('portal.auth.register');
})->name(name: "portal.register");
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/portal/dashboard', [PortalController::class, 'index'])->name(name: "portal.dashboard");

    Route::get('/portal/veterinarians', function () {
        return view('portal.main.vets.vetsList');
    })->name(name: "portal.vets");

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
    Route::post('/portal/appointments/update', [PortalController::class, 'updateMyAppointment'])->name(name: "portal.appointments.update");
    Route::post('/portal/appointments/cancel', [PortalController::class, 'cancelMyAppointments'])->name(name: "portal.appointments.cancel");

    Route::get('/portal/profile', [PortalController::class, 'profile'])->name(name: "portal.profile");
    Route::post('/portal/profile/update', [PortalController::class, 'updateProfile'])->name('portal.profile.update');
    Route::post('/portal/profile/upload', [PortalController::class, 'uploadProfile'])->name('portal.profile.upload');

    Route::get('/portal/prescription/', [PortalController::class, 'prescription'])->name("portal.prescription.list");
    Route::get('/portal/prescription/print', function () {
        return view('portal.main.prescriptions.print');
    })->name("portal.prescription.print");

    Route::get('/printable/prescription/print', function () {
        return view('printable.prescription');
    })->name("printable.prescription");

    Route::get('/portal/appointments/request', function () {
        return view('portal.main.scheduling.request');
    })->name("portal.scheduling.request");

});
require __DIR__ . '/auth.php';
