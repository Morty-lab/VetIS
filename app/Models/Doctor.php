<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'firstname', 'lastname', 'address', 'phone_number', 'birthday', 'position','license_number'];


    protected $casts = [
        'password' => 'hashed',
    ];

    // Create a new doctor
    public static function createDoctor($data)
    {
        return self::create($data);
    }

    // Retrieve all doctors
    public static function getAllDoctors()
    {
        return self::all();
    }



    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }


    // Retrieve a single doctor by ID
    public static function getDoctorById($id)
    {
        return self::where('id',$id)->first();
    }

    // Update a doctor
    public function updateDoctor($data)
    {
        $this->fill($data);
        $this->save();
    }

    // Delete a doctor
    public function deleteDoctor()
    {
        $this->delete();
    }

    public static function getSchedules($id){
        return Appointments::where('doctor_id', $id)->get();
    }


    public static function setEmailAttribute(Doctor $doctor, $id)
    {
        $email = User::where('id', $id)->value('email');

        // Set the client's email attribute
        $doctor->doctor_email = $email;

        // Optionally, you could save the client if needed
//         $doctor->save();

        return $doctor;
    }
}
