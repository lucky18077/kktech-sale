<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertySubCategory extends Model
{
    protected $table = 'property_subcategories';

    protected $fillable = [
        'property_category_id',
        'name',
        'active'
    ];

    public function propertyCategory()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }
}
