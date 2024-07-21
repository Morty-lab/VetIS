<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;


    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'supplier_email_address',
        'supplier_phone_number',
        'supplier_contact_person'
    ];

    public static function getAllSuppliers(){
        return self::all();
    }

    public static function getSupplier($id){
        return self::find($id);
    }

    public static function addSupplier($data){

        return self::create($data);
    }

    public static  function updateSupplier($data, $id){
        return self::find($id)->update($data);
    }


    public static function deleteSupplier($id){
        return self::find($id)->delete();
    }



}
