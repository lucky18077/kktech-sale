<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadMaster extends Model
{
     protected $table = 'lead_mst';

     protected $fillable = [
        'source_id',
        'state',
        'city',
        'address',
        'last_comment',
        'user_id',
        'type',
        'catg_id',
        'sub_catg_id',
        'plumber_id',
        'architect_id',
        'property_stage_id',
        'client_id',
        'mep_id',
        'customer_type',
        'business_category_id',
        'status_id'
    ];
}
