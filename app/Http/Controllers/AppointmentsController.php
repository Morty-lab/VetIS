<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentSet;
use App\Models\Appointments;
use App\Models\Clients;
use App\Models\Doctor;
use App\Models\Notifications;
use App\Models\Pets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Services;
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

        $services = Services::where('service_type', 'services')->get();

        return view('appointments.manage', ["clients" => $clients, "pets" => $pets, "appointments" => $appointments, "vets" => $vets, "services" => $services]);
    }

    public function getAvailableTimes(Request $request)
    {
        $selectedDate = $request->input('date');
        $selectedVet = $request->input('vet');

        // Define available time slots
        $allTimes = [
            "08:00",
            "08:30",
            "09:00",
            "09:30",
            "10:00",
            "10:30",
            "11:00",
            "11:30",
            "13:00",
            "13:30",
            "14:00",
            "14:30",
            "15:00",
            "15:30",
            "16:00",
            "16:30",
            // "17:00",
        ];

        // Get booked times for the selected date
        $bookedTimes = Appointments::where('appointment_date', $selectedDate)
            ->where('doctor_ID', $selectedVet)->where('status', 0)
            ->pluck('appointment_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        // Get the current time and remove the time from the all times that is less than the current time
        $currentTime = Carbon::now()->format('H:i');
        if ($selectedDate == Carbon::now()->format('Y-m-d')) {
            $allTimes = array_filter($allTimes, function ($time) use ($currentTime) {
            return strtotime($time) > strtotime($currentTime);
        });
        }



        // Filter out booked times
        $availableTimes = array_diff($allTimes, $bookedTimes);

        return response()->json(
            array_values($availableTimes)
        );
    }

    public function view($id)
    {

        $appointment = Appointments::with(['client', 'pet'])->find($id);
        $vets = Doctor::getAllDoctors();
        $services = Services::getAllServices();


        return view('appointments.view', ["appointment" => $appointment, "vets" => $vets, "services" => $services]);
    }

    public function appointmentSchedule($id)
    {
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 0;
        $priority_number = Appointments::generateAppointmentNumber(Carbon::parse($appointment->appointment_date), Carbon::parse($appointment->appointment_time),$appointment->doctor_ID);
        $appointment->priority_number = $priority_number;
        $appointment->save();

        $client = Clients::find($appointment->owner_ID);
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');

        $veterinarian = Doctor::where('id', $appointment->doctor_ID)->first();
        $veterinarian->setEmailAttribute($veterinarian, $veterinarian->user_id);


        $data = [
            'subject' => 'Appointment Approved',
            'content' => "Dear $client->client_name,\n\n" .
                "Your appointment request for $date at $time has been **approved**. " .
                "We look forward to seeing you then!\n\n" .
                "Thank you for choosing us!",
            'status' => 'Approved'
        ];

        $ownerData = [
            'subject' => 'Appointment Scheduled',
            'content' => "Dear Dr. $veterinarian->firstname $veterinarian->lastname,\n\n" .
                "An appointment has been scheduled for you.\n\n" .
                "Details of the appointment:\n" .
                "- **Client Name**: $client->client_name\n" .
                "- **Date**: $date\n" .
                "- **Time**: $time\n\n" .
                "Please review the details and prepare accordingly. If you have any questions, contact the clinic staff.\n\n" .
                "Thank you!",
            'status' => 'Scheduled'
        ];

        Mail::to($veterinarian->doctor_email)->cc($veterinarian->doctor_email)->send(new AppointmentSet($ownerData));
        Mail::to($client->client_email)->cc($client->client_email)->send(new AppointmentSet($data));
        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('appointments.view', ['id' => $id]),
            'notification_type' => 'info',
            'message' => "Appointment for $veterinarian->firstname $veterinarian->lastname on $date at $time has been scheduled.",
        ]);
        return redirect()->route('appointments.view', ['id' => $id])->with('success', 'Appointment has been scheduled successfully!');
    }

    public function appointmentDone($id)
    {
        $appointment = Appointments::with(['client', 'pet'])->find($id);
        $veterinarian = Doctor::where('id', $appointment->doctor_ID)->first();

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
        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('appointments.view', ['id' => $id]),
            'notification_type' => 'success',
            'message' => "Appointment for $veterinarian->firstname $veterinarian->lastname on $date at $time has been Conducted.",
        ]);

        return redirect()->route('appointments.view', ['id' => $id])->with('success', 'Appointment has been completed successfully!');
    }

    public function appointmentCancel($id)
    {
        $appointment = Appointments::with(['client', 'pet'])->find($id);

        $appointment->status = 2;
        $appointment->save();

        $client = Clients::find($appointment->owner_ID);
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($appointment->appointment_date)->format('l, F j, Y');
        $time = Carbon::parse($appointment->appointment_time)->format('g:i A');


        $veterinarian = Doctor::where('id', $appointment->doctor_ID)->first(); // Doctor::getDoctorById($appointment->doctor_ID)->first();
        $veterinarian->setEmailAttribute($veterinarian, $veterinarian->user_id);

        Notifications::addNotif([
            'visible_to' => "staff,veterinarian",
            'link' => route('appointments.view', ['id' => $id]),
            'notification_type' => 'danger',
            'message' => "Appointment for $veterinarian->firstname $veterinarian->lastname on $date at $time has been cancelled.",
        ]);


        $ownerData = [
            'subject' => 'Appointment Cancelled',
            'content' => "Dear Dr. $veterinarian->firstname $veterinarian->lastname,\n\n" .
                "We regret to inform you that the following appointment has been cancelled:\n\n" .
                "Details of the cancelled appointment:\n" .
                "- **Client Name**: $client->client_name\n" .
                "- **Date**: $date\n" .
                "- **Time**: $time\n\n" .
                "If you have any questions or require further assistance, please contact the clinic staff.\n\n" .
                "Thank you for your understanding.",
            'status' => 'Cancelled'
        ];


        $data = [
            'subject' => 'Appointment Cancelled',
            'content' => "Dear $client->client_name,\n\n" .
                "We regret to inform you that your appointment request for $date at $time has been **cancelled**. " .
                "Please contact us if you have any questions.\n\n" .
                "Thank you for your understanding.",
            'status' => 'Cancelled'
        ];

        Mail::to($veterinarian->doctor_email)->cc($veterinarian->doctor_email)->send(new AppointmentSet($ownerData));
        Mail::to($client->client_email)->send(new AppointmentSet($data));

        return redirect()->route('appointments.view', ['id' => $id])->with('success', 'Appointment has been cancelled successfully!');
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
            'appointment_time' => 'nullable',
            'reasonOfVisit' => 'required',
            'remarks' => 'nullable',
        ]);

        // dd($validatedData);




        // Create a new appointment using the validated data
        // $request->merge(['pet_ID' => implode(',', $request->input('pet_ID'))]);
        $priority_number = Appointments::generateAppointmentNumber(Carbon::parse($request->appointment_date), Carbon::parse($request->appointment_time),$request->input('doctor_ID'));
        $request->merge([
            'pet_ID' => implode(',', $request->input('pet_ID')),
            'purpose' => implode(',', $request->input('reasonOfVisit')),
            'status' => 0,
            'priority_number' => $priority_number
        ]);

        $result = Appointments::createAppointment($request->all());


        Log::info('Appointment creation result:', ['saved' => $result]);
        $client = Clients::find($request->input('owner_ID'));
        Clients::setEmailAttribute($client, $client->user_id);
        $date = Carbon::parse($request->input('appointment_date'))->format('l, F j, Y'); // E.g., Monday, November 5, 2024
        $time = Carbon::parse($request->input('appointment_time'))->format('g:i A'); // E.g., 3:00 PM

        $veterinarian = Doctor::where('id', $result->doctor_ID)->first();
        $veterinarian->setEmailAttribute($veterinarian, $veterinarian->user_id);




        $data = [
            'subject' => 'Appointment Approved',
            'content' => "Dear $client->client_name,\n\n" .
                "Your appointment request for $date at $time has been **approved**. " .
                "We look forward to seeing you then!\n\n" .
                "Thank you for choosing us!",
            'status' => 'Approved'
        ];

        $ownerData = [
            'subject' => 'Appointment Scheduled',
            'content' => "Dear Dr. $veterinarian->firstname $veterinarian->lastname,\n\n" .
                "An appointment has been scheduled for you.\n\n" .
                "Details of the appointment:\n" .
                "- **Client Name**: $client->client_name\n" .
                "- **Date**: $date\n" .
                "- **Time**: $time\n\n" .
                "Please review the details and prepare accordingly. If you have any questions, contact the clinic staff.\n\n" .
                "Thank you!",
            'status' => 'Scheduled'
        ];

        Mail::to($veterinarian->doctor_email)->cc($veterinarian->doctor_email)->send(new AppointmentSet($ownerData));
        Mail::to($client->client_email)->cc($client->client_email)->send(new AppointmentSet($data));
        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('appointments.view', ['id' => $result->id]),
            'notification_type' => 'success',
            'message' => "Appointment for Dr. $veterinarian->firstname $veterinarian->lastname on $date at $time has been scheduled.",
        ]);
        return redirect()->route('appointments.view', ['id' => $result->id])->with('success', 'Appointment has been scheduled successfully!');
        // return redirect()->route('appointments.index');

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
    public function update(Request $request)
    {
        $appid = request('appid');
        // Validate the form fields
        // dd($request->all());
        $validatedData = $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today', // Appointment date must be valid and not in the past
            'appointment_time' => 'required|date_format:H:i',           // Valid time format
            'doctor_ID' => 'required|exists:doctors,id',           // Ensure the doctor exists
        ]);

        // Find the appointment by ID
        $appointment = Appointments::findOrFail($appid);
        // dd($appointment);

        // Update the appointment details
        $appointment->appointment_date = $validatedData['appointment_date'];
        $appointment->appointment_time = $validatedData['appointment_time'];
        $appointment->doctor_ID = $validatedData['doctor_ID'];
        $priority_number = Appointments::generateAppointmentNumber(Carbon::parse($appointment->appointment_date), Carbon::parse($appointment->appointment_time),$appointment->doctor_ID);
        $appointment->priority_number = $priority_number;

        // Save the changes
        $appointment->save();

        // Retrieve the veterinarian
        $client = Clients::find($appointment->owner_ID);
        Clients::setEmailAttribute($client, $client->user_id);
        $veterinarian = Doctor::where('id', $appointment->doctor_ID)->first();
        $veterinarian->setEmailAttribute($veterinarian, $veterinarian->user_id);

        $newDate = Carbon::parse($request->input('appointment_date'))->format('l, F j, Y'); // E.g., Monday, November 5, 2024
        $newTime = Carbon::parse($request->input('appointment_time'))->format('g:i A'); // E.g., 3:00 PM


        $veterinarianData = [
            'subject' => 'Appointment Rescheduled',
            'content' => "Dear Dr. $veterinarian->firstname $veterinarian->lastname,\n\n" .
                "We would like to inform you that the following appointment has been rescheduled:\n\n" .
                "Updated details of the appointment:\n" .
                "- **Client Name**: $client->client_name\n" .
                "- **New Date**: $newDate\n" .
                "- **New Time**: $newTime\n\n" .
                "If you have any questions or require further assistance, please contact the clinic staff.\n\n" .
                "Thank you for your understanding.",
            'status' => 'Rescheduled'
        ];

        $clientData = [
            'subject' => 'Appointment Rescheduled',
            'content' => "Dear $client->client_name,\n\n" .
                "We would like to inform you that your appointment request has been **rescheduled**. " .
                "Below are the updated details:\n\n" .
                "- **New Date**: $newDate\n" .
                "- **New Time**: $newTime\n\n" .
                "If you have any questions or need to make further changes, please contact us.\n\n" .
                "Thank you for your understanding.",
            'status' => 'Rescheduled'
        ];

        Mail::to($veterinarian->doctor_email)->send(new AppointmentSet($veterinarianData));

        Mail::to($client->client_email)->send(new AppointmentSet($clientData));

        Notifications::addNotif([
            'visible_to' => "staff",
            'link' => route('appointments.view', ['id' => $appid]),
            'notification_type' => 'success',
            'message' => "Appointment for $veterinarian->firstname $veterinarian->lastname on $appointment->appointment_date at $appointment->appointment_time has been re-scheduled to $newDate at $newTime.",
        ]);

        // Redirect back with a success message
        return redirect()->route('appointments.view', ['id' => $appid])->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointments)
    {
        //
    }
}
