<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailsModel extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
    ];

    public static function storeDetails($data){
        return self::create($data);
    }
}
