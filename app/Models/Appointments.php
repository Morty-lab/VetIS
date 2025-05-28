<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_ID',
        'pet_ID',
        'doctor_ID',
        'appointment_date',
        'appointment_time',
        'priority_number',
        'status',
        'purpose',
        'remarks',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'owner_ID');
    }

    public function pet()
    {
        return $this->belongsTo(Pets::class, 'pet_ID');
    }


    public static function generateAppointmentNumber($date, $time, $doctor_ID)
    {
        $prefix = 'A';
        $doctor = Doctor::where('id', $doctor_ID)->first();
        $suffix = strtoupper(substr($doctor->firstname, 0, 1) . substr($doctor->lastname, 0, 1));

        // Check for similar appointment times on the selected date
        // $similarAppointmentsCount = self::where('appointment_date', $date->format('Y-m-d'))
        //     ->where('appointment_time', $time->format('H:i'))
        //     ->count();

        // Add a letter suffix (a-z) if there are similar times
        // $letterSuffix = $similarAppointmentsCount > 0 ? chr(64 + $similarAppointmentsCount) : '';

        return $prefix . '-' . $time->format('Hi') . '-' . $suffix;


        // return $prefix . '-' . $time->format('Hi');
    }

    public static function getAllAppointments()
    {
        return self::all();
    }

    public static function getAppointmentByClient($client)
    {
        return self::where('owner_ID', $client)->get();
    }


    public static function getAppointmentById($id)
    {
        return self::find($id);
    }

    public static function createAppointment($data)
    {
        return self::create($data);
    }

    public static function updateAppointment($id, $data)
    {
        $appointment = self::find($id);
        if ($appointment) {
            $appointment->fill($data)->save();
            return $appointment;
        }
        return null;
    }

    public static function deleteAppointment($id)
    {
        $appointment = self::find($id);
        if ($appointment) {
            return $appointment->delete();
        }
        return false;
    }



}
