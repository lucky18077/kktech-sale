<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DealerCategory
 */
class DealerCategory extends Model
{
    use HasFactory;

    protected $table = 'dealer_category';

    protected $fillable = [
        'dealer_id',
        'category_id',
    ];

    public $timestamps = true;

    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
