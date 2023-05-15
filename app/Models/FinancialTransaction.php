<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','patient_id','appointment_id','method', 'payment_amount', 'comment', 'pay_time', 'changeable', 'is_active'
    ];
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class,"patient_id","national_code");
    }

    public function appointment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    protected function payTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtotime($value),
            set: fn ($value) => date('Y-m-d H:i:s', (($value/1000)+(3600*3.5))),
        );
    }

    protected function payTimeGetter(): Attribute{
        return Attribute::make(
            get: fn () => is_null($this->pay_time)
                ? (null)
                : (new Verta($this->pay_time))->format('Y/n/j  H:i')
        );
    }
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value), //1402
            set: fn () => date('Y-m-d H:i:s', time()+(3600*3.5)),
        );
    }
}
