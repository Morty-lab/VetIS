<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stocks extends Model
{
    protected $fillable = [
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
        return $this->belongsTo(Products::class, 'id');
    }

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class);
    }


    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'id');
    }

    public static function addStock($data)
    {

        return self::create($data);
    }

   public static function repackStock($stock_id, $quantity)
    {
        $stock = self::find($stock_id);

        if (!$stock) {
            throw new \Exception("Stock not found.");
        }

        $available = $stock->stock - $stock->subtracted_stock;

        if ($available < $quantity) {
            throw new \Exception("Not enough stock to subtract.");
        }

        $stock->subtracted_stock += $quantity;
        $stock->save();

        return true;
    }

    public static function subtractStock($product_id, $requiredStock)
    {
        // Fetch all stocks for the given product, ordered by expiry date
        $requiredStockCopy = $requiredStock;
        $productStocks = Stocks::where('products_id', $product_id)
            ->orderBy('expiry_date', 'asc')
            ->get();

        foreach ($productStocks as $productStock) {
            $availableStock = $productStock->stock - $productStock->subtracted_stock;

            if ($requiredStockCopy <= $availableStock) {
                $productStock->subtracted_stock += $requiredStockCopy;
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
            $requiredStockCopy -= $availableStock; // Reduce the remaining required stock
            $productStock->subtracted_stock += $availableStock; // Deplete the current available stock
            $productStock->save();
        }

        // If the loop completes but there are still unmet stock requirements, throw an exception
        if ($requiredStockCopy > 0) {
            throw new Exception("Not enough stock available to fulfill the request.");
        }

        return true;
    }


    public static function getAllStocksByProductId($product_id)
    {
        return self::where('products_id', $product_id)->orderBy('expiry_date', 'asc')->get();
    }


}
