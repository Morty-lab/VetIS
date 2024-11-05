<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stocks extends Model
{protected $fillable = [
    'stock',
    'price',
    'unit',
    'status',
    'products_id',
    'supplier_id',
    'user_id',
    'expiry_date'
];



    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class,'id');
    }

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class);
    }


    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class,'id');
    }

    public static function addStock($data)
    {

        return self::create($data);
    }

    public static function subtractStock($product_id, $stock){
        $productStock = Stocks::where('products_id', $product_id)->orderBy('expiry_date', 'asc')->first();

        $newStock = $productStock->stock - $stock;

        $productStock->stock = $newStock;
        $productStock->save();

        if ($productStock->stock == 0){

            $productStock->delete();
            $product = Products::where('id', $product_id)->firstOrFail();
            $product->status = 0;
            $product->save();

        }

        return $productStock;

    }
}
