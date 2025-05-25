<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosageModel extends Model
{
    use HasFactory;

    protected $table = 'dosages';
    protected $fillable = [
        'date_administered',
        'next_scheduled_dose',
        'status',
        'administered_by',
        'vaccination_id',
    ];

    public function administeredBy()
    {
        return $this->belongsTo(Doctor::class, 'administered_by', 'id');
    }

    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class, 'vaccination_id', 'id');
    }
}

