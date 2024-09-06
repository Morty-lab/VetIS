<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stocks extends Model
{protected $fillable = [
    'stock',
    'price',
    'unit',
    'status',
    'products_id',
    'expiry_date'
];



    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class,'product_id');
    }

    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class,'id');
    }

    public static function addStock($data)
    {

        return self::create($data);
    }
}
