<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_name',
        'client_no',
        'client_address',
        'client_birthday'
    ];

    public function pets()
    {
        return $this->hasMany(Pets::class, 'owner_ID');
    }

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'owner_ID');
    }

    public static function getAllClients()
    {
        return self::all();
    }

    public static function getClientById($id)
    {
        return self::find($id);
    }

    public static function createClient($data){
        return self::create($data);
    }
    public static function updateClient($id, $data)
    {
        return self::find($id)->update($data);
    }

    public static function deleteClient($id)
    {
        $client = self::find($id);
        if ($client) {
            return $client->delete();
        }
        return false;
    }

    public static function petsOwned($ownerID = null){
        $query = Pets::where('owner_id', $ownerID);

        if ($ownerID === null) {
            return $query->get();
        } else {
            return $query->where('owner_ID', $ownerID)->get();
        }
    }

//    public function getAgeAttribute()
//    {
//        return Carbon::parse($this->attributes['birthday'])->age;
//    }

    public function getEmailAttribute($id)
    {
        $email = User::where('id', $id)->value('email');

        return $this->attributes['owner_email'] = $email;
    }
}
