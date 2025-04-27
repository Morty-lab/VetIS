<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'service_name',
        'service_price',
        'service_type',
    ];


    public static function getAllServices(){
        return self::all();
    }

    public static function getServiceById($id){
        return self::find($id);
    }

    public static function addService($service){
        return self::create($service);
    }

    public static function updateService($service){
        return self::update($service);
    }

    public static function deleteService($id){
        return self::destroy($id);
    }
}
