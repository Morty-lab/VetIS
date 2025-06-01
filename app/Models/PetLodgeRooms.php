<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetLodgeRooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public static function createRooms($number)
    {
        for ($i = 0; $i < $number; $i++) {
            self::create([
                'status' => 0
            ]);
        }
    }

    public static function deleteRoom($id)
    {
        return self::find($id)->delete();
    }
}

