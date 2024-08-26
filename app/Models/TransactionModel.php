<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'client_id',
        'sub_total',
        'total_discount',
    ];

    public static function storeTransaction($data)
    {

        $newRecord = self::create($data);


        return $newRecord->id;
    }
}
