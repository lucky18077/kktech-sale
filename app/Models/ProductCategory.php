<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'active',
    ];

    public function subcategories()
    {
        return $this->hasMany(ProductSubcategory::class, 'product_category_id');
    }
}
