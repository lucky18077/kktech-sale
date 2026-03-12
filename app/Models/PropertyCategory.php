<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    protected $table = 'property_categories';

    protected $fillable = [
        'name',
        'type',
        'active'
    ];

    public function subcategories()
    {
        return $this->hasMany(PropertySubcategory::class, 'property_category_id');
    }
}
