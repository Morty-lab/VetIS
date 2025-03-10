<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stocks extends Model
{protected $fillable = [
    'stock',
    'price',
    'supplier_price',
    'unit',
    'status',
    'products_id',
    'supplier_id',
    'user_id',
    'expiry_date',
    'subtracted_stock'
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

    public static function subtractStock($product_id, $requiredStock)
    {
        // Fetch all stocks for the given product, ordered by expiry date
        $productStocks = Stocks::where('products_id', $product_id)
            ->orderBy('expiry_date', 'asc')
            ->get();

        foreach ($productStocks as $productStock) {
            if ($productStock->stock <= $productStock->subtracted_stock + $requiredStock) {
                continue;
            }
            // If the required stock is less than or equal to the current stock
            if ($requiredStock <=  $productStock->subtracted_stock) {
                // Subtract the required stock from the current stock
                $productStock->subtracted_stock += $requiredStock;
                $productStock->save();

                // Mark as inactive if the stock reaches zero
                if ($productStock->subtracted_stock == $productStock->stock) {
                    $productStock->status = 0;
                    $productStock->save();
                }

                // All stock has been subtracted, so break the loop
                return true;
            }

            // If the required stock exceeds the current stock
            $requiredStock -= $productStock->stock; // Reduce the remaining required stock
            $productStock->subtracted_stock = $productStock->stock; // Deplete the current stock
            $productStock->status = 0; // Mark as inactive
            $productStock->save();
        }

        // If the loop completes but there are still unmet stock requirements, throw an exception
        if ($requiredStock > 0) {
            throw new Exception("Not enough stock available to fulfill the request.");
        }

        return true;
    }


    public static function getAllStocksByProductId($product_id){
        return self::where('products_id', $product_id)->orderBy('expiry_date', 'asc')->get();
    }


}
