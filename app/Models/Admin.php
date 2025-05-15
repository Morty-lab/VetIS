<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address',
        'phone_number',
        'birthday',
        'position',
        'profile_picture',
        'middlename',
        'extensionname',

    ];



    public static function getAllAdmins(){
        return self::all();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function getEmailAttribute($id)
    {
        $email = User::where('id', $id)->value('email');

        return $this->attributes['admin_email'] = $email;
    }

    public static function getAdmin($id){
        $admin = Admin::find($id);
        return $admin;
    }

    public static function addAdmin($data){
        return self::create($data);
    }

}
