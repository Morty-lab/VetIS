<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_ID',
        'record_date',
        'pet_weight',
        'pet_temperature',
        'medication_given',
        'procedure_given',
        'remarks',
    ];

    public static function getAllPetRecords()
    {
        return self::all();
    }

    public static function getPetRecordById($id)
    {
        return self::find($id);
    }

    public static function findByPetId($petId)
    {
        return self::where('pet_ID', $petId)->get();
    }
    public static function createPetRecord($data)
    {
        return self::create($data);
    }
    public static function updatePetRecord($id, $data)
    {
        $petRecord = self::find($id);
        if ($petRecord) {
            $petRecord->fill($data)->save();
            return $petRecord;
        }
        return null;
    }
    public static function deletePetRecord($id)
    {
        $petRecord = self::find($id);
        if ($petRecord) {
            return $petRecord->delete();
        }
        return false;
    }

}
