<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'vaccine_type',
        'doctor_id',
        'next_vaccine_date',
        'status',
    ];


    public static function getVaccinations(){
        return self::all();

    }

    public static function getVaccinationByPet($id){
        return self::where('pet_id',$id)->get();

    }

    public static function addVaccination($data){
        return self::create($data);
    }
}
