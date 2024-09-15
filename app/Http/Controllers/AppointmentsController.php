<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('appointments.view');
        $clients = Clients::all();
        $pets = Pets::all();
        $appointments = Appointments::with('client')->orderBy('appointment_date', 'asc')->get();
        $vets = Doctor::getAllDoctors();

        return view('appointments.manage', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets]);
    }

    public function view($id){

        $appointment = Appointments::with(['client', 'pet'])->find($id);

        return view('appointments.view', ["appointment" => $appointment]);
    }

    public function appointmentDone($id){
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 1;
        $appointment->save();

        return redirect()->route('appointments.view', ['id' => $id]);
    }

    public function appointmentCancel($id){
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 2;
        $appointment->save();

        return redirect()->route('appointments.view', ['id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'owner_ID' => 'required',
            'pet_ID' => 'required',
            'doctor_ID' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'purpose' => 'required',
        ]);



        // Create a new appointment using the validated data
        $appointment = new Appointments($validatedData);
        $result = $appointment->save();



        Log::info('Appointment creation result:', ['saved' => $result]);
        return redirect()->route('appointments.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $appointments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointments)
    {
        //
    }
}
