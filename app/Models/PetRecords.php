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
        'subject',
        'doctorID',
        'record_date',
        'consultation_type',
        'complaint',
        'examination',
        'diagnosis',
        'medication_given',
        'procedure_given',
        'remarks',
        'prescription_notes',
        'treatment_notes',
        'status',
    ];

     public function pet()
     {
         return $this->belongsTo(Pets::class, 'petID');
     }
     /**
      * Get the owner/client associated with this record
      */
     public function clients()
     {
         return $this->belongsTo(Clients::class, 'ownerID');
     }

     /**
      * Get the doctor associated with this record
      */
     public function doctor()
     {
         return $this->belongsTo(Doctor::class, 'doctorID');
     }

    public static function getAllPetRecords()
    {
        return self::all();
    }

    public static function getPrescriptions($id)
    {
        return self::where('ownerID', $id)->get();
    }

    public static function getPetRecordById($id)
    {
        return self::where('id', $id)->first();
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
