<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $primaryKey = 'national_code';
    protected $fillable = [
        'national_code','firstname','lastname', 'day', 'month', 'year','insurance_id','mobile','phone'
    ];
    public $incrementing = false;

    public function insurance(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }

    public function appointments():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Appointment::class,"patient_id");
    }

    public function financialTransactions():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FinancialTransaction::class,"patient_id");
    }

    public function reports():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Report::class,"patient_id");
    }

    public function prescriptions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            Prescription::class,
            Appointment::class,
            "patient_id",
            "appointment_id",
            "national_code",
            "id"
        );
    }
}
