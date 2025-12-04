<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'id_order',
        'id_reporter',
        'report_type',
        'description',
        'status',
        'admin_notes',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
        ];
    }

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'id_reporter');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isResolved()
    {
        return $this->status === 'resolved';
    }

    public function resolve($adminNotes = null)
    {
        $this->update([
            'status' => 'resolved',
            'admin_notes' => $adminNotes,
            'resolved_at' => now(),
        ]);
    }
}
