<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegotiationOffer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_negotiation',
        'id_sender',
        'offered_price',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'offered_price' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    // Relationships
    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class, 'id_negotiation');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'id_sender');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }
}
