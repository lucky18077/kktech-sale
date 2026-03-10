<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerType extends Model
{
     protected $table = 'partnerTypes';
     protected $fillable = [
          'company',
          'name',
          'number',
          'dob',
          'doa',
          'address',
          'state',
          'city',
          'active',
          'type',
          'remarks'
     ];
}
