<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentSet;
use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Pets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    public function appointmentSchedule($id){
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 0;
        $appointment->save();

        $client = Clients::find($appointment->owner_ID);
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        $data = [
            'subject' => 'Appointment Approved',
            'content' => "Dear $client->client_name,\n\n" .
                "Your appointment request for $date at $time has been **approved**. " .
                "We look forward to seeing you then!\n\n" .
                "Thank you for choosing us!",
            'status' => 'Approved'
        ];


        Mail::to($client->client_email)->send(new AppointmentSet($data));
        return redirect()->route('appointments.view', ['id' => $id]);
    }

    public function appointmentDone($id){
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 1;
        $appointment->save();

        $client = Clients::find($appointment->owner_ID);
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        $data = [
            'subject' => 'Appointment Completed',
            'content' => "Dear $client->client_name,\n\n" .
                "Thank you for attending your appointment on $date at $time. " .
                "We hope we provided the care you and your pet needed.\n\n" .
                "If you have any feedback, feel free to reach out!",
            'status' => 'Done'
        ];

        Mail::to($client->client_email)->send(new AppointmentSet($data));

        return redirect()->route('appointments.view', ['id' => $id]);
    }

    public function appointmentCancel($id){
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 2;
        $appointment->save();

        $client = Clients::find($appointment->owner_ID);
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        $data = [
            'subject' => 'Appointment Cancelled',
            'content' => "Dear $client->client_name,\n\n" .
                "We regret to inform you that your appointment request for $date at $time has been **cancelled**. " .
                "Please contact us if you have any questions.\n\n" .
                "Thank you for your understanding.",
            'status' => 'Cancelled'
        ];


        Mail::to($client->client_email)->send(new AppointmentSet($data));

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
        $client = Clients::find($request->input('owner_ID'));
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($request->input('appointment_date'))->format('l, F j, Y'); // E.g., Monday, November 5, 2024
        $time = Carbon::parse($request->input('appointment_time'))->format('g:i A'); // E.g., 3:00 PM

        $data = [
            'subject' => 'Appointment Request Submitted',
            'content' => "Dear $client->client_name,\n\n" .
                "Your appointment request for $date at $time has been submitted successfully. " .
                "Our vet secretary will evaluate your request and get back to you shortly.\n\n" .
                "Thank you for your patience!",
            'status' => 'Pending'
        ];



        Mail::to($client->client_email)->send(new AppointmentSet($data));
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
