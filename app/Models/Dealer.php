<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Dealer
 */
class Dealer extends Model
{
    use HasFactory;

    protected $table = 'dealer';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'pincode',
        'address',
        'state',
        'city',
        'gst',
        'pan_number',
        'adhar_number',
        'team_ids',
        'dealer_category_id',
        'category',
        'company'
    ];
}