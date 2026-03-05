<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 */
class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'setting_key',
        'setting_value',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\SettingFactory::new();
    }
}
