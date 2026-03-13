<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'number',
        'email',
        'address',
        'state',
        'city',
        'district',
        'company',
        'gst',
        'city',
        'pincode',
        'ship_address',
        'ship_state',
        'ship_district',
        'ship_city',
        'ship_pincode',
        'active',
    ];
    protected $table = 'customers';
    
    // Optimize queries
    public $timestamps = false; // Disable timestamps if not needed
    
    // Disable incrementing if using UUID
    // public $incrementing = false;
    // protected $keyType = 'string';
}
