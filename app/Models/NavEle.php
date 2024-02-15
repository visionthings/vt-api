<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavEle extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
    ];
     public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

}
