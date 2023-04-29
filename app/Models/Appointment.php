<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class,"patient_id","national_code");
    }
    protected $fillable = [
        'patient_id','type', 'visit_time', 'descriptions'
    ];
    protected $primaryKey = 'id';

    protected function visitTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtotime($value),
            set: fn ($value) => date('Y-m-d H:i:s', $value),
        );
    }

}
