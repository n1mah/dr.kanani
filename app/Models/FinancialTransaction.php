<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class,"patient_id","national_code");
    }
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value), //1402
            set: fn () => date('Y-m-d H:i:s', time()+(3600*3.5)),
        );
    }
    protected $fillable = [
        'title','patient_id','method', 'payment_amount', 'comment'
    ];
}
