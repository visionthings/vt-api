<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }
    protected  $fillable = ['email', 'token'];
}
