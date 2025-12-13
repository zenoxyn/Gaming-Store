<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    protected $fillable = [
        'id_product',
        'id_buyer',
        'id_seller',
        'latest_buyer_offer',
        'latest_seller_offer',
        'status',
        'expires_at',
        'coinflip_proposed_by',
    ];

    protected function casts(): array
    {
        return [
            'latest_buyer_offer' => 'integer',
            'latest_seller_offer' => 'integer',
            'expires_at' => 'datetime',
        ];
    }

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'id_buyer');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'id_seller');
    }

    public function offers()
    {
        return $this->hasMany(NegotiationOffer::class, 'id_negotiation');
    }

    public function coinFlipGame()
    {
        return $this->hasOne(CoinFlipGame::class, 'id_negotiation');
    }

    // Helper methods
    public function getLatestOffer()
    {
        return $this->offers()->latest()->first();
    }

    public function isOngoing()
    {
        return $this->status === 'ongoing';
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    public function needsCoinFlip()
    {
        return $this->status === 'coinflip';
    }

    public function isExpired()
    {
        return $this->expires_at && now()->greaterThan($this->expires_at);
    }

    public function updateExpiry()
    {
        $this->expires_at = now()->addDay();
        $this->save();
    }

    public function calculateDpAmount()
    {
        if (!$this->latest_buyer_offer || !$this->latest_seller_offer) {
            return 0;
        }

        return abs($this->latest_seller_offer - $this->latest_buyer_offer) * 0.5;
    }
}
