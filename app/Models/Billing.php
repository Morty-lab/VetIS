<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billing';
    protected $fillable = [
        'biller_id',
        'vet_id',
        'user_id',
        'payment_type',
        'total_payable',
        'total_paid',
        'discount',
        'due_date',
    ];

    public static function getAllBillsByClient($id){
        return self::where('user_id',$id)->get();
    }
}
