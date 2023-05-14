<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id','prescription_id','title', 'content'
    ];
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class,"patient_id","national_code");
    }

    public function prescription(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Prescription::class,"prescription_id");
    }

    public function report_images():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ReportImage::class,"report_id");
    }
}
