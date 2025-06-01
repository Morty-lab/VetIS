<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    use HasFactory;
protected $fillable = [
    'recordID',
    'productID',
    'dosage',
    'price',
    'frequency',
    'medication_type'
];

}
