<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'email'
    ];
}
