<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestedMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'company_name',
        'company_type',
        'company_size',
        'message'
    ];
}
