<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['unit_name'];

    use HasFactory;

    public function stocks()
    {
        return $this->hasMany(Stocks::class, 'unit');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'unit');
    }

    public static function getAllUnits()
    {
        return self::all();
    }

    public static function createUnit($data)
    {
        return self::create($data);
    }

    public static function updateUnit($data, $id)
    {
        return self::find($id)->update($data);
    }

    public static function deleteUnit($id)
    {
        return self::find($id)->delete();
    }


}
