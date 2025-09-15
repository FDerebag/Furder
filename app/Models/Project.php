<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'detailed_description',
        'client',
        'category',
        'technologies',
        'project_url',
        'github_url',
        'image_path',
        'gallery',
        'duration_days',
        'completed_at',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'gallery' => 'array',
        'completed_at' => 'date',
        'is_featured' => 'boolean',
    ];

    protected $attributes = [
        'status' => 'completed',
        'is_featured' => false,
        'sort_order' => 0,
    ];

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getTechnologiesListAttribute()
    {
        return is_array($this->technologies) ? implode(', ', $this->technologies) : '';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'completed' => 'success',
            'ongoing' => 'warning', 
            'paused' => 'secondary',
        ];

        return $badges[$this->status] ?? 'primary';
    }
}
