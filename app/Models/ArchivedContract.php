<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchivedContract extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_number',
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'commercial_number',
        'indoor_cameras',
        'outdoor_cameras',
        'storage_device',
        'period_of_record',
        'show_screens',
        'camera_type',
        'contract_date',
        'expiry_date',
        'price',
        'vat',
        'discount',
        'total_price',
        'is_paid'
    ];
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
