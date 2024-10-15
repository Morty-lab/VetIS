<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetPlan extends Model
{
    use HasFactory;

    protected $table = 'pet_plan';
    protected $fillable = [
        'pet_record_id',
        'service_name',
        'date_return',
        'reason_for_return',
        'status'
    ];

    public static function getAllByRecordID($petID){
        return self::where('pet_record_id', $petID)->get();
    }

    public static function createPlan($data){
        return self::create($data);
    }

    public static function updatePlan($id,$data){
        return self::find($id)->update($data);
    }

    public static function deletePlan($data){
        return self::destroy($data);
    }
}
