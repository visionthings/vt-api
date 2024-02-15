<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;
     protected $fillable = [
        'page_id',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'content_type',
        'file_1',
        'file_2',
        'file_3',
        'file_4',
        'file_5',
        'file_6',
        'file_7',
        'file_8',
        'file_9',
        'file_10',
        'file_11',
        'file_12',
        'file_13',
        'file_14',
        'file_15',
        'file_16',
        'file_17',
        'file_18',
        'file_19',
        'file_20',
        'file_21',
        'file_22',
        'file_23',
        'file_24',
        'file_25',
    ];
    public function Pages(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
