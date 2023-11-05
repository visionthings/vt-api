<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
      'name' ,
      'phone',
      'email',
      'company_type',
      'commercial_number',
      'tax_number',
      'city',
      'building_number',
      'street_name',
      'second_number',
      'district',
      'zip_code',
      'indoor_cameras',
      'outdoor_cameras',
      'storage_device',
      'period_of_record',
      'show_screens',
      'camera_type',
      'contract_date',
      'expiry_date',
      'contract_number',
      'paid_amount',
      'discount'
    ];
}
