<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'category_name'
    ];

    public function product()
    {
        return $this->hasMany(Products::class);
    }

    public static function getAllCategories(){
        return self::all();
    }

    public static function createCategory($data){
        return self::create($data);
    }

    public static function updateCategory($data,$id){
        return self::find($id)->update($data);
    }

    public static function deleteCategory($id){
        return self::find($id)->delete();
    }
}

