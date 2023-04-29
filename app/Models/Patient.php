<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function insurance(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }
    public function appointments():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Appointment::class,"patient_id");
    }
    public $incrementing = false;
    protected $primaryKey = 'national_code';
    protected $fillable = [
            'national_code','firstname','lastname', 'day', 'month', 'year','insurance_id','mobile','phone'
    ];

}
