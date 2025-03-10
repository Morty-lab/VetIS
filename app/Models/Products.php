<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_category',
        'unit',
        'status',
        'stock',
        'SKU',

    ];


    public function stocks(): HasMany
    {
        return $this->hasMany(Stocks::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class,'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'id');
    }

    public static function getAllProducts()
    {
        return self::all();
    }

    public static function getProductById($id)
    {
        return self::find($id);
    }

    public static function createProduct($data)
    {
        return self::create($data);
    }

    public static function updateProduct($id, $data)
    {
        return self::find($id)->update($data);
    }

    public static function deleteProduct($id)
    {
        $product = self::find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }

}
