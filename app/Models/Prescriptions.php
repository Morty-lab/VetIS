<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'recordID',
        'medication_id',
        'dosage',
        'frequency',
        'duration',
    ];

    public function record()
    {
        return $this->belongsTo(PetRecords::class, 'recordID', 'id');
    }

    public function medication()
    {
        return $this->belongsTo(Products::class, 'medication_id', 'id');
    }

}

