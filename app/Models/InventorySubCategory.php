<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InventorySubCategory
 */
class InventorySubCategory extends Model
{
    use HasFactory;

    protected $table = 'inv_subcatg';

    protected $fillable = [
        'catg_id',
        'subcat_name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'catg_id');
    }
}
