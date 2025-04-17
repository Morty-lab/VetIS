<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Doctor;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all services first
        $services = \App\Models\Services::pluck('service_name', 'id')->toArray();

        // Load appointments with needed relationships and filter out those with null status
        $appointments = \App\Models\Appointments::with(['client', 'pet'])
            ->whereNotNull('status')  // Exclude appointments with a null status
            ->where('status', '!=', 2)  // Exclude appointments where status is equal to 2
            ->get();

        // Format data for FullCalendar
        $formattedAppointments = $appointments->map(function ($appointment) use ($services) {
            // Prepare service name(s)
            $serviceNames = '';
            if (!empty($appointment->purpose)) {
                $serviceIds = explode(',', $appointment->purpose);
                $mappedNames = array_map(function ($id) use ($services) {
                    return $services[trim($id)] ?? '';
                }, $serviceIds);
                $serviceNames = implode(', ', array_filter($mappedNames));
            }

            // Get Pet Owner Name
            $ownerName = $appointment->client ? $appointment->client->client_name : 'Unknown Owner';


            // Status label
            $status = $appointment->status == 1 ? 'Completed' : 'Scheduled';

            // Get Attending Veterinarian
            $veterinarian = Doctor::where('id', $appointment->doctor_ID)->first();
            $doctorName = $veterinarian ?  $veterinarian->firstname . ' ' . $veterinarian->lastname : 'Unknown Vet';

            return [
                'id' => $appointment->id,
                'title' => "Dr. $doctorName   |   Owner: $ownerName   |   Service: $serviceNames   |   Status: $status",
                'start' => $appointment->appointment_date . 'T' . $appointment->appointment_time,
                'end' => $appointment->appointment_date . 'T' . $appointment->appointment_time,
            ];
        });

        return view('schedule.calendar', ['appointments' => json_encode($formattedAppointments)]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
