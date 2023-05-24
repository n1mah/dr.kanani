<?php

namespace App\Models;

use Database\Seeders\ItemsAnalysisSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items_analysis extends Model
{
    use HasFactory;
    public function analysis(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Analysis::class);
    }

}
