<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function appointment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    use HasFactory;

    protected $fillable = [
        'appointment_id','reason', 'type', 'text_prescription'
    ];
    protected $primaryKey = 'id';
}
