<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = ['user_id', 'firstname', 'lastname', 'address', 'phone_number', 'position', 'birthday','profile_picture'];



    public static function getStaff()
    {
        return self::all();
    }

    public static function getStaffById($id)
    {
        return self::where('id', $id)->first();
    }

    public static function createStaff($data)
    {
        return self::create($data);
    }

    public static function updateStaff($id, $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function deleteStaff($id)
    {
        return self::where('id', $id)->delete();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function getEmailAttribute($id)
    {
        $email = User::where('id', $id)->value('email');

        return $this->attributes['staff_email'] = $email;
    }
}
