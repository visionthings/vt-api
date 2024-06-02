<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_type',
        'commercial_number',
        'building_number',
        'street',
        'district',
        'city'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
