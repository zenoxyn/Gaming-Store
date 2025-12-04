<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    protected $fillable = [
        'id_product',
        'id_buyer',
        'id_seller',
        'status',
    ];

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
}
