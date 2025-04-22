<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pets extends Model
{
    use HasFactory;

    protected $fillable = [
        'ownerID',
        'pet_type',
        'pet_name',
        'pet_breed',
        'pet_gender',
        'pet_birthdate',
        'pet_color',
        // 'pet_weight',
        'vaccinated',
        'neutered',
        'pet_description',
        'pet_picture',
        'status',
        'isArchived',
        'vaccinated_anti_rabies',
        'anti_rabies_vaccination_date',
        'history_of_aggression',
        'food_allergies',
        'pet_food',
        'okay_to_give_treats',
        'last_groom_date',
        'okay_to_use_photos_online',
        'pet_condition',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'owner_ID');
    }

    public function appointment()
    {
        return $this->hasMany(Appointments::class, 'pet_ID');
    }

    public function pet()
    {
        return $this->hasMany(Appointments::class, 'pet_ID');
    }

    public function record()
    {
        return $this->hasMany(PetRecords::class, 'petID');
    }

    public static function getAllPets()
    {
        return self::all();
    }

    public static function getPetByClient($client)
    {
        return self::where('owner_ID', $client)->get();
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

    public function getAgeAttribute()
    {
        $birthdate = Carbon::parse($this->attributes['pet_birthdate']);
        $now = Carbon::now();

        $years = $birthdate->diffInYears($now);
        if ($years > 0) {
            return $years . ' year' . ($years > 1 ? 's' : '') . ' old';
        }

        $months = $birthdate->diffInMonths($now);
        if ($months > 0) {
            return $months . ' month' . ($months > 1 ? 's' : '') . ' old';
        }

        $days = $birthdate->diffInDays($now);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' old';
    }

}
