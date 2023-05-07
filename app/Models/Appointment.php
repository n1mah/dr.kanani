<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mokhosh\Jarbon\JarbonTrait;

class Appointment extends Model
{
    use JarbonTrait;
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

//    protected function visitTimeJ(): Attribute
//    {
//        return Attribute::make(
//            get: fn() => $this->visit_time, //1402
////            set: fn () => date('Y-m-d H:i:s', $value),
//        );
//    }
     protected function visitTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  $value->jormat("y"), //1402
//            set: fn ($value) => date('Y-m-d H:i:s', $value),
        );
    }

    protected function changeStatus(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (strtotime($value))-(60*60*1), //1402
            set: fn ($value) => date('Y-m-d H:i:s', $value),
        );
    }

}
