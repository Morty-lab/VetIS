<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'recordID',
        'serviceID',
        'outcome',
    ];

    public function record()
    {
        return $this->belongsTo(PetRecords::class, 'recordID', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'serviceID', 'id');
    }
}

