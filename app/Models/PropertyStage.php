<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PropertyStage
 */
class PropertyStage extends Model
{
    use HasFactory;

    protected $table = 'property_stage';

    protected $fillable = [
        'stage_name',
        'description',
        'active',
    ];


    public function projects()
    {
        return $this->hasMany(Project::class, 'property_stage_id');
    }
}
