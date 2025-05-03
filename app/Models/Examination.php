<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;



    protected $fillable = [
        'pet_record_id',
        'temperature',
        'heart_rate',
        'respiration_rate',
        'weight',
        'length',
        'height',
        'body_condition',
        'general_appearance',
        'skin_coat_condition',
        'eyes_ears_nose_throat',
        'mouth_teeth',
        'lymph_nodes',
        'cardiovascular_system',
        'respiratory_system',
        'digestive_system',
        'musculoskeletal_system',
        'neurological_system'
    ];

    protected $table = 'examinations';


    public static function getAllExaminations(){
        return self::all();
    }

    public static function getExaminationByePet($id){
        return self::where('pet_record_id', $id)->get();
    }

    public static function addExaxmination($data){
        return self::create($data);
    }

    public static function getExaminationByRecordID($id){
        return self::where('pet_record_id', $id)->get()->first();
    }

}
