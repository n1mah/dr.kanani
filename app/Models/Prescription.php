<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id','reason','text_prescription'
    ];
    protected $primaryKey = 'id';

    public function appointment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function reports():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Report::class,"prescription_id");
    }

    public function images():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Image::class,"prescription_id");
    }
}
