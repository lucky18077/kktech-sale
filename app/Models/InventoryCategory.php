<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InventoryCategory
 */
class InventoryCategory extends Model
{
    use HasFactory;

    protected $table = 'inv_catg';

    protected $fillable = [
        'cat_name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function subCategories()
    {
        return $this->hasMany(InventorySubCategory::class, 'catg_id');
    }
}
