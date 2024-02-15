<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;
     protected $fillable = [
        'nav_ele_id',
        'title_ar',
        'title_en',
        'slug'
    ];

    public function NavEle(): BelongsTo
    {
        return $this->belongsTo(NavEle::class);
    }

    public function Contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
