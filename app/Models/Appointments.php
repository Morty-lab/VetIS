<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_ID',
        'pet_ID',
        'appointment_date',
        'appointment_time',
        'status',
        'purpose',
    ];

    public static function getAllAppointments()
{
    return self::all();
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
