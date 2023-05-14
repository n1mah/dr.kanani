<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id','type', 'visit_time', 'descriptions', 'status', 'change_status'
    ];
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class,"patient_id","national_code");
    }
    public function prescriptions():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Prescription::class);
    }
    public function financialTransactions():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    protected function visitTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtotime($value), //1402
            set: fn ($value) => date('Y-m-d H:i:s', (($value/1000)+(3600*3.5))),
        );
    }

    protected function changeStatus(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtotime($value), //1402
            set: fn ($value) => date('Y/m/d  H:i:s', ($value+(3600*3.5))),
        );
    }

    protected function visitTimeGetter(): Attribute{
        return Attribute::make(
            get: fn () => is_null($this->visit_time)
                ? (null)
                : (new Verta($this->visit_time))->format('Y/n/j  H:i')
        );
    }
}
