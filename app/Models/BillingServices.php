<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingServices extends Model
{
    use HasFactory;

    protected $table = 'billing_services';
    protected $fillable = [
        'billing_id',
        'service_id',
    ];
}
