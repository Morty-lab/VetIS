<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'firstname', 'lastname', 'address', 'phone_number', 'birthday', 'position'];


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
        return self::find($id);
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
}
