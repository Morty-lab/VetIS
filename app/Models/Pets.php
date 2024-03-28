<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    use HasFactory;

    protected $fillable = [
        'ownerID',
        'pet_name',
        'pet_breed',
        'pet_gender',
        'pet_birthdate',
        'pet_markings',
    ];

    public static function getAllPets()
    {
        return self::all();
    }

    public static function getPetById($id)
    {
        return self::find($id);
    }

    public static function createPet($data)
    {
        return self::create($data);
    }

    public static function updatePet($id, $data)
    {
        $pet = self::find($id);
        if ($pet) {
            $pet->fill($data)->save();
            return $pet;
        }
        return null;
    }

    public static function deletePet($id)
    {
        $pet = self::find($id);
        if ($pet) {
            return $pet->delete();
        }
        return false;
    }

}
