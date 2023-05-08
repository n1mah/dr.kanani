<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class Appointment extends Model
{

    use HasFactory;
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class,"patient_id","national_code");
    }
    public function prescriptions():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Prescription::class);
    }
    protected $fillable = [
        'patient_id','type', 'visit_time', 'descriptions', 'status', 'change_status'
    ];
    protected $primaryKey = 'id';

    protected function visitTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (new Verta((strtotime($value))))->format('Y/n/j  H:i') , //1402
            set: fn ($value) => date('Y-m-d H:i:s', ($value+(3600*3.5))),
        );
    }
    protected function changeStatus(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (new Verta((strtotime($value))))->format('Y/n/j  H:i'), //1402
            set: fn ($value) => date('Y/m/d  H:i:s', ($value+(3600*3.5))),
        );
    }

}
