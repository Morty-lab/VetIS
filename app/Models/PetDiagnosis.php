<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_record_id',
        'diagnosis',
        'treatment',
        'prescription',
        'client_communication',
    ];

    protected $table = 'pet_diagnosis';

    public static function getAllDiagnosis(){
        return self::all();
    }


    public static function getDiagnosisByPet($id){
        return self::where('pet_record_id', $id)->get()->first();
    }

    public static function addDiagnosis($data){
        return self::create($data);
    }
}
