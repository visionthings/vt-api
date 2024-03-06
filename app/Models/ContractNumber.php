<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_number'
    ];
}
