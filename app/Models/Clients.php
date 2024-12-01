<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_name',
        'client_no',
        'client_address',
        'client_birthday',
        'client_profile_picture',
        'status',
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

    public static function getClientByUserID($user_id)
    {
        return self::where('user_id',$user_id)->first();
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

    public static function setEmailAttribute(Clients $client, $id)
    {
        $email = User::where('id', $id)->value('email');

        // Set the client's email attribute
        $client->client_email = $email;

        // Optionally, you could save the client if needed
        // $client->save();

        return $client;
    }

}
