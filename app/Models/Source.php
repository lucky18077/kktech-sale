<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
   protected $fillable = [
        'source_name',
        'active',
    ];
    protected $table = 'sources';
    
    // Optimize queries
    public $timestamps = false; // Disable timestamps if not needed
    
    // Disable incrementing if using UUID
    // public $incrementing = false;
    // protected $keyType = 'string';
}
