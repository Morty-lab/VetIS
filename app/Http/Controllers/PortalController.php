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

    public function addMyPet(Request $request){
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_breed' => 'required',
            'pet_gender' => 'required',
            'pet_birthdate' => 'required|date',
            'pet_color' => 'required',
            'pet_weight' => 'required|numeric',
        ]);

        $pet = new Pets($validatedData);
        $client = Clients::getClientByUserID(Auth::user()->id);
        $pet->owner_ID = $client->id;

        $pet->save();

        return redirect()->route('portal.mypets');
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

        $validatedData = $request->validate([
            'owner_ID' => 'required',
            'pet_ID' => 'required',
            'doctor_ID' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'purpose' => 'required',
        ]);

        $appointment = new Appointments($validatedData);
        $result = $appointment->save();


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
        return redirect()->route('portal.appointments');
    }

    public function viewMyAppointments(){
        $petID = request('petid');
        $appointmentID = request('appid');
        $appointment = Appointments::getAppointmentById($appointmentID);
        $pet = Pets::getPetByID($petID);



        return view('portal.main.scheduling.view',['appointment'=>$appointment, 'pet'=>$pet]);
    }



    public function profile(){

        return view('portal.main.profile.profile');
    }


}
