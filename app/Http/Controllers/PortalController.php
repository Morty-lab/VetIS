<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentSet;
use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Pets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointments::getAppointmentByClient(auth()->user()->id);

        return view('portal.main.dashboard',['appointments'=>$appointments]);

    }

    public function myPets(){
        $client = Clients::getClientByUserID(Auth::user()->id);
        $pets = Pets::getPetByClient($client->id);
        return view('portal.main.pets.petsList',['pets'=>$pets]);
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
            'pet_weight' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png|max:5120', // File validation
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

        // Save the pet
        $pet->save();

        // Redirect to the pets page
        return redirect()->route('portal.mypets')->with('success', 'Pet registered successfully!');
    }


    public function viewMyPet(Request $request){
        $id = request('petid');
        $pet = Pets::getPetByID($id);
        $appointments = Appointments::where('pet_ID',$id)->get();
        $vets = Doctor::getAllDoctors();

        return view('portal.main.pets.view',['pet'=>$pet, 'appointments'=>$appointments, 'vets'=>$vets]);
    }

    public function editMyPet(Request $request){
        $id = request('petid');
        $pet = Pets::getPetByID($id);

        return view('portal.main.pets.edit',['pet'=>$pet]);

    }

    public function updateMyPet(Request $request){
        $id = request('petid');
        $pet = Pets::getPetByID($id);
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_breed' => 'required',
            'pet_gender' => 'required',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required',
            'pet_weight' => 'required',
        ]);


        $pet->update($validatedData);
        $pet->save();

        return redirect()->route('portal.mypets.view', ['petid'=>$pet->id]);
    }

    public function myAppointments(){
        $client = Clients::getClientByUserID(auth()->user()->id);
        $appointments = Appointments::getAppointmentByClient($client->id);
        $pets = Pets::getPetByClient($client->id);
        $vets = Doctor::getAllDoctors();

        return view('portal.main.scheduling.appointments',['appointments'=>$appointments , 'pets'=>$pets, 'vets'=>$vets]);
    }

    public function addMyAppointment(Request $request){

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
            'purpose' => 'required',
        ]);

        if ($validator->fails()) {
            // Add an error toast message
            toastr()->addError('Error submitting appointment request please try again.');

            // Redirect back with the input and validation errors
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $appointment = new Appointments($request->all());
        $appointment->save();


        $date = Carbon::parse($request->input('appointment_date'))->format('l, F j, Y'); // E.g., Monday, November 5, 2024
        $time = Carbon::parse($request->input('appointment_time'))->format('g:i A'); // E.g., 3:00 PM
        $name = Auth::user()->name;


        $data = [
            'subject' => 'Appointment Request Submitted',
            'content' => "Dear $name,\n\n" .
                "Your appointment request for $date at $time has been submitted successfully. " .
                "Our vet secretary will evaluate your request and get back to you shortly.\n\n" .
                "Thank you for your patience!",
            'status' => 'Pending'
        ];




        Mail::to(Auth::user()->email)->send(new AppointmentSet($data));

        toastr()->addSuccess('Appointment request submitted successfully.');

        return redirect()->route('portal.appointments');
    }

    public function viewMyAppointments(){
        $petID = request('petid');
        $appointmentID = request('appid');
        $appointment = Appointments::getAppointmentById($appointmentID);
        $pet = Pets::getPetByID($petID);
        $pets = Pets::getPetByClient($pet->owner_ID);
        $vets = Doctor::getAllDoctors();



        return view('portal.main.scheduling.view',['appointment'=>$appointment, 'pet'=>$pet , 'pets'=>$pets, 'vets'=>$vets]);
    }

    public function updateMyAppointment(Request $request){
        $id = request('appointmentID');

        $appointment = Appointments::getAppointmentById($id);
//        dd($request->all());

        $validatedData = $request->validate([
            'doctor_ID' => 'required',
            'pet_ID' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'purpose' => 'required',
        ]);

        $appointment->updateAppointment($id,$validatedData);

        $name = Auth::user()->name;



        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        $data = [
            'subject' => 'Appointment Updated',
            'content' => "Dear $name,\n\n" .
                "Your appointment has been **updated**. The new schedule is as follows:\n" .
                "**Date**: $date\n" .
                "**Time**: $time\n\n" .
                "If you have any questions or need further assistance, feel free to reach out.\n\n" .
                "Thank you for choosing us!",
            'status' => 'Updated'
        ];

        Mail::to(Auth::user()->email)->send(new AppointmentSet($data));


        return redirect()->route('portal.appointments.view', ['petid'=>$appointment->pet_ID, 'appid'=>$appointment->id]);
    }



    public function profile(){

        return view('portal.main.profile.profile');
    }


}
