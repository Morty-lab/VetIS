<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'petID',
        'ownerID',
        'doctorID',
        'record_date',
        'consultation_type',
        'complaint',
        'interpretation',
        'status',
    ];

     public function pet()
     {
         return $this->belongsTo(Pets::class);
     }

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
        return self::where('petID', $petId)->get();
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
