<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company',
        'project_type',
        'budget',
        'project_details',
        'timeline',
        'is_read',
        'read_at',
        'notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    // Accessors
    public function getProjectTypeDisplayAttribute()
    {
        $types = [
            'web' => 'Web Uygulaması',
            'mobile' => 'Mobil Uygulama',
            'desktop' => 'Desktop Uygulama',
            'ecommerce' => 'E-Ticaret',
            'crm' => 'CRM Sistemi',
            'erp' => 'ERP Sistemi',
            'api' => 'API Geliştirme',
            'other' => 'Diğer',
        ];

        return $types[$this->project_type] ?? $this->project_type;
    }

    public function getBudgetDisplayAttribute()
    {
        if (!$this->budget) return 'Belirtilmedi';

        $budgets = [
            '0-25000' => '0 - 25.000 TL',
            '25000-50000' => '25.000 - 50.000 TL',
            '50000-100000' => '50.000 - 100.000 TL',
            '100000-250000' => '100.000 - 250.000 TL',
            '250000+' => '250.000 TL+',
        ];

        return $budgets[$this->budget] ?? $this->budget;
    }

    public function getTimelineDisplayAttribute()
    {
        if (!$this->timeline) return 'Belirtilmedi';

        $timelines = [
            'asap' => 'En kısa sürede',
            '1month' => '1 ay içinde',
            '3months' => '3 ay içinde',
            '6months' => '6 ay içinde',
            'flexible' => 'Esnek',
        ];

        return $timelines[$this->timeline] ?? $this->timeline;
    }
}
