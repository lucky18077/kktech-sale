<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Lead
 */
class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lead_ref_no',
        'user_id',
        'contact_name',
        'contact_number',
        'email',
        'address',
        'state',
        'city',
        'area_id',
        'status',
        'source_id',
        'project_id',
        'notes',
        'lead_date',
        'last_contact_date',
        'active',
    ];

    protected $casts = [
        'lead_date' => 'date',
        'last_contact_date' => 'datetime',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(AreaMaster::class, 'area_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function comments()
    {
        return $this->hasMany(LeadComment::class, 'lead_id')->orderByDesc('created_at');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'lead_product', 'lead_id', 'product_id')
            ->withPivot('quantity', 'interested_price', 'remarks')
            ->withTimestamps();
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'lead_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'lead_id');
    }

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    public function scopeByUser(Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeRecent(Builder $query)
    {
        return $query->orderByDesc('lead_date')->orderByDesc('created_at');
    }

    public function scopeByLocation(Builder $query, $state, $city = null)
    {
        $query->where('state', $state);
        
        if ($city) {
            $query->where('city', $city);
        }

        return $query;
    }

    public function scopeByDateRange(Builder $query, $startDate, $endDate)
    {
        return $query->whereBetween('lead_date', [$startDate, $endDate]);
    }
}
