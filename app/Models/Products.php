<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_category',
        'price',
        'unit',
        'status',
        'stock',
    ];

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
    $product = self::find($id);
    if ($product) {
        $product->fill($data)->save();
        return $product;
    }
    return null;
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
