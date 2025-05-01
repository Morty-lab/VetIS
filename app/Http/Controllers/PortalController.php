<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentSet;
use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Notifications;
use App\Models\PetRecords;
use App\Models\Pets;
use App\Models\Prescriptions;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Clients::getClientByUserID(Auth::id());
        $appointments = Appointments::getAppointmentByClient($client->id);
        $vets = Doctor::getAllDoctors();
        $pets = Pets::getAllPets($client->id);


        return view('portal.main.dashboard', ['appointments' => $appointments, 'vets' => $vets, 'pets' => $pets]);
    }

    public function myPets()
    {
        $client = Clients::getClientByUserID(Auth::user()->id);
        $pets = Pets::getPetByClient($client->id);
        return view('portal.main.pets.petsList', ['pets' => $pets]);
    }

    public function addMyPet(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'pet_breed' => 'required|string|max:255',
            'pet_gender' => 'required|string|max:10',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required|string|max:50',
            // 'pet_weight' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png|max:5120', // File validation
        ]);

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pet_photos', 'public');
            $validatedData['pet_picture'] = $photoPath; // Add photo path to validated data
        }

        // Create a new pet record
        $pet = new Pets($validatedData);

        // Assign the owner ID
        $client = Clients::getClientByUserID(Auth::user()->id);
        $pet->owner_ID = $client->id;


        Notifications::addNotif([
            'visible_to' => $client->id,
            'link' => route('appointments.mypets'),
            'notification_type' => 'success',
            'message' => "A new pet has been added",
        ]);

        // Save the pet
        $pet->save();
        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('pets.show', $pet->id),
            'notification_type' => 'success',
            'message' => $client->client_name.  "Has added a new pet",
        ]);


        // Redirect to the pets page
        return redirect()->route('portal.mypets')->with('success', 'Pet registered successfully!');
    }


    public function viewMyPet(Request $request)
    {
        $id = request('petid');
        $pet = Pets::getPetByID($id);
        $appointments = Appointments::where('pet_ID', $id)->get();
        $vets = Doctor::getAllDoctors();

        return view('portal.main.pets.view', ['pet' => $pet, 'appointments' => $appointments, 'vets' => $vets]);
    }

    public function editMyPet(Request $request)
    {
        $id = request('petid');
        $pet = Pets::getPetByID($id);

        return view('portal.main.pets.edit', ['pet' => $pet]);
    }

    public function updateMyPet(Request $request)
    {
        $id = request('petid');
        $pet = Pets::getPetByID($id);
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_breed' => 'required',
            'pet_gender' => 'required',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required',
            // 'pet_weight' => 'required',
        ]);


        $pet->update($validatedData);
        $pet->save();

        return redirect()->route('portal.mypets.view', ['petid' => $pet->id]);
    }

    public function myAppointments()
    {
        $client = Clients::getClientByUserID(auth()->user()->id);
        $appointments = Appointments::getAppointmentByClient($client->id);
        $pets = Pets::getPetByClient($client->id);
        $vets = Doctor::getAllDoctors();
        $services = Services::getAllServices();




        return view('portal.main.scheduling.appointments', ['appointments' => $appointments, 'pets' => $pets, 'vets' => $vets, 'services' => $services]);
    }

    public function addMyAppointment(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'owner_ID' => 'required',
            'pet_ID' => 'required',
            'doctor_ID' => 'required',
            'appointment_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $appointmentDate = Carbon::parse($value);
                    if ($appointmentDate->isPast() && !$appointmentDate->isToday()) {
                        $fail('The appointment date cannot be in the past.');
                    }
                },
            ],
            'appointment_time' => [
                'required',
                function ($attribute, $value, $fail) {
                    $time = Carbon::createFromFormat('H:i', $value);
                    $start = Carbon::createFromTime(8, 0); // 8:00 AM
                    $end = Carbon::createFromTime(18, 0); // 6:00 PM

                    if ($time->lt($start) || $time->gt($end)) {
                        $fail('The appointment time must be between 8:00 AM and 6:00 PM.');
                    }
                },
            ],
            'reasonOfVisit' => 'required',
            'remarks' => 'nullable',
        ]);

        if ($validator->fails()) {
            // Add an error toast message

            toastr()
                ->positionClass('toast-bottom-right')
                ->addError('Error submitting appointment request please try again.');

            // Redirect back with the input and validation errors
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $request->merge([
            'pet_ID' => implode(',', $request->input('pet_ID')),
            'purpose' => implode(',', $request->input('reasonOfVisit')),
        ]);


        $newapp = Appointments::createAppointment($request->all());


        $date = Carbon::parse($request->input('appointment_date'))->format('l, F j, Y'); // E.g., Monday, November 5, 2024
        $time = Carbon::parse($request->input('appointment_time'))->format('g:i A'); // E.g., 3:00 PM
        $name = Auth::user()->name;
        $veterinarian = Doctor::where('id', $request->input('doctor_ID'))->first();


        $data = [
            'subject' => 'Appointment Request Submitted',
            'content' => "Dear $name,\n\n" .
                "Your appointment request for $date at $time has been submitted successfully. " .
                "Our vet secretary will evaluate your request and get back to you shortly.\n\n" .
                "Thank you for your patience!",
            'status' => 'Pending'
        ];

        Mail::to(Auth::user()->email)->send(new AppointmentSet($data));

        toastr()
            ->positionClass('toast-bottom-right')
            ->addSuccess('Appointment request submitted successfully.');

            Notifications::addNotif([
                'visible_to' => "staff",
                'link' => route('appointments.view', ['id' => $newapp->id]),
                'notification_type' => 'info',
                'message' => "Appointment for $veterinarian->firstname $veterinarian->lastname on $date at $time has been requested by $name.",
            ]);

        return redirect()->route('portal.appointments')->with([
            'appointment_success' => true,
            'pending_modal_data' => [
                'owner_name' => Auth::user()->name,
                'pet_ids' => explode(',', $request->input('pet_ID')),
                'reason' => $request->input('purpose'),
                'veterinarian' => Doctor::find($request->input('doctor_ID'))->name,
                'appointment_date' => $request->input('appointment_date'),
                'appointment_time' => $request->input('appointment_time'),
            ],
        ]);

    }

    public function viewMyAppointments()
    {
        $petID = request('petid');
        $appointmentID = request('appid');
        $appointment = Appointments::getAppointmentById($appointmentID);
        $pet = Pets::getPetByID($petID);
        $pets = Pets::getPetByClient($pet->owner_ID);
        $vets = Doctor::getAllDoctors();
        $services = Services::getAllServices();



        return view('portal.main.scheduling.view', ['appointment' => $appointment, 'pet' => $pet, 'pets' => $pets, 'vets' => $vets, 'services' => $services]);
    }

    public function updateMyAppointment(Request $request)
    {
        // dd($request->all());
        $id = request('appointmentID');

        $appointment = Appointments::getAppointmentById($id);

        $request->merge([
            'pet_ID' => implode(',', $request->input('pet_ID')),
            'purpose' => implode(',', $request->input('reasonOfVisit')),
        ]);


        $appointment->updateAppointment($id, $request->all());

        $name = Auth::user()->name;
        $veterinarian = Doctor::where('id', $appointment->doctor_ID)->first();



        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        $data = [
            'subject' => 'Appointment Rescheduled',
            'content' => "Dear $name,\n\n" .
                "Your appointment has been **re-scheduled**. The new schedule is as follows:\n" .
                "**Date**: $date\n" .
                "**Time**: $time\n\n" .
                "If you have any questions or need further assistance, feel free to reach out.\n\n" .
                "Thank you for choosing us!",
            'status' => 'Re-scheduled'
        ];



        Mail::to(Auth::user()->email)->send(new AppointmentSet($data));

        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('appointments.view', ['id' => $appointment->id]),
            'notification_type' => 'info',
            'message' => "Appointment for $veterinarian->firstname $veterinarian->lastname on $date at $time has been requested by $name.",
        ]);


        return redirect()->route('portal.appointments.view', ['petid' => $appointment->pet_ID, 'appid' => $appointment->id]);
    }

    public function cancelMyAppointments(Request $request)
    {
        $appointmentID = request('appid');

        $appointment = Appointments::getAppointmentById($appointmentID);

        $appointment->update(['status' => 2]);
        $appointment->save();

        $name = Auth::user()->name;
        $pet = Pets::getPetByID($appointment->pet_ID);



        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        // Inform the user about the cancellation
        $userData = [
            'subject' => 'Appointment Cancelled',
            'content' => "Dear $name,\n\n" .
                "Your appointment scheduled for:\n" .
                "**Date**: $date\n" .
                "**Time**: $time\n\n" .
                "has been **cancelled**. If you'd like to reschedule, please visit our portal to set a new appointment.\n\n" .
                "Thank you for choosing us!",
            'status' => 'Cancelled'
        ];
        Mail::to(Auth::user()->email)->send(new AppointmentSet($userData));

        // Notify the vet about the cancellation
        $doctor = Doctor::getDoctorById($appointment->doctor_ID); // Retrieve the doctor by ID
        if ($doctor) {
            $vetEmail = User::where('id', $doctor->user_id)->value('email'); // Get the vet's email using the user_id

            $vetData = [
                'subject' => 'Appointment Cancelled',
                'content' => "Dear Dr. {$doctor->firstname} {$doctor->lastname},\n\n" .
                    "The following appointment has been **cancelled**:\n\n" .
                    "**Owner**: $name \n" .
                    "**Pet**: $pet->pet_name  ($pet->pet_type )\n" .
                    "**Date**: $date\n" .
                    "**Time**: $time\n\n" .
                    "If you have any questions, please contact our office.\n\n" .
                    "Thank you!",
                'status' => 'Cancelled'
            ];

            Mail::to($vetEmail)->send(new AppointmentSet($vetData));
        }

        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('appointments.view', ['id' => $appointment->id]),
            'notification_type' => 'danger',
            'message' => "Appointment for $doctor->firstname $doctor->lastname on $date at $time has been cancelled by $name.",
        ]);


        toastr()
            ->positionClass('toast-bottom-right')
            ->addSuccess('Appointment cancelled successfully.');

        return redirect()->route('portal.appointments.view', ['petid' => $appointment->pet_ID, 'appid' => $appointment->id]);
    }

    public function prescription()
    {
        $id = request('id');
        $prescriptions = PetRecords::getPrescriptions($id);

        return view('portal.main.prescriptions.prescriptionList', ['prescriptions' => $prescriptions]);
    }



    public function profile()
    {
        $owner = Clients::getClientByUserID(Auth::id());
        return view('portal.main.profile.profile', ['owner' => $owner]);
    }

    public function updateProfile(Request $request)
    {
        $id = $request->input('id');

        try {
            // Validate the request inputs
            $request->validate([
                'client_name' => 'required|string|max:255',
                'client_birthday' => 'required|date',
                'client_address' => 'required|string|max:255',
                'client_email' => 'required|email|max:255',
                'client_no' => 'required|string|max:15',
            ]);

            // Update the client details in the Clients model
            $client = Clients::find($id);
            if (!$client) {
                toastr()->addError('Client not found.');
                return redirect()->back()->with('error', 'Client not found.');
            }

            // Update the client's fields
            $client->update([
                'client_name' => $request->input('client_name'),
                'client_birthday' => $request->input('client_birthday'),
                'client_address' => $request->input('client_address'),
                'client_no' => $request->input('client_no'),
            ]);

            // Update the email in the User model
            $user = User::find($client->user_id);
            if ($user) {
                $user->update([
                    'email' => $request->input('client_email'),
                ]);
            }


            return redirect()->back()->with('success', 'Account updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, add an error toast for each validation error
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    toastr()
                        ->positionClass('toast-bottom-right')
                        ->addError($message);
                }
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function uploadProfile(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);
        $id = request('id');
        $client = Clients::getClientById($id); // Assuming the client is associated with the logged-in user



        if ($request->hasFile('photo')) {
            // Generate a unique filename
            $photoPath = $request->file('photo')->store('profile_photos', 'public');

            // Delete the old photo if it exists
            if ($client->client_profile_picture && Storage::disk('public')->exists($client->client_profile_picture)) {
                Storage::disk('public')->delete($client->client_profile_picture);
            }

            // Update the client's photo field in the database
            $client->update(['client_profile_picture' => $photoPath]);
        }

        toastr()
            ->positionClass('toast-bottom-right')
            ->addSuccess('Profile photo updated successfully.');
        return redirect()->back();
    }
}
