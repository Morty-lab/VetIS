<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;



    protected $fillable = [
        'pet_record_id',
        'heart_rate',
        'respiration_rate',
        'weight',
        'length',
        'crt',
        'bcs',
        'lymph_nodes',
        'palpebral_reflexes',
        'temperature'
    ];

    protected $table = 'examination';


    public static function getAllExaminations(){
        return self::all();
    }

    public static function getExaminationByePet($id){
        return self::where('pet_record_id', $id)->get();
    }

    public static function addExaxmination($data){
        return self::create($data);
    }

}
