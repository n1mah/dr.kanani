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
    public $incrementing = false;
    protected $primaryKey = 'national_code';
    protected $fillable = [
            'national_code','firstname','lastname', 'birthday','insurance_id','mobile','phone'
    ];

}
