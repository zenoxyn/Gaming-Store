<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinFlipGame extends Model
{
    protected $fillable = [
        'id_negotiation',
        'id_buyer',
        'id_seller',
        'dp_amount',
        'buyer_dp_paid',
        'buyer_call',
        'result',
        'winner',
        'final_price',
        'game_status',
        'played_at',
    ];

    protected function casts(): array
    {
        return [
            'dp_amount' => 'integer',
            'final_price' => 'integer',
            'buyer_dp_paid' => 'boolean',
            'played_at' => 'datetime',
        ];
    }

    // Relationships
    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class, 'id_negotiation');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'id_buyer');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'id_seller');
    }

    // Game logic
    public function flip()
    {
        $this->result = rand(0, 1) ? 'heads' : 'tails';
        $this->winner = ($this->result === $this->buyer_call) ? 'buyer' : 'seller';
        $this->played_at = now();
        $this->game_status = 'finished';

        // Calculate final price based on winner
        $negotiation = $this->negotiation;
        $latestOffer = $negotiation->getLatestOffer();
        $product = $negotiation->product;

        if ($this->winner === 'buyer') {
            $this->final_price = $latestOffer->offered_price; // Buyer's offer
        } else {
            $this->final_price = $product->getCurrentPrice(); // Seller's price
        }

        $this->save();
        return $this;
    }

    public function isWaitingDp()
    {
        return $this->game_status === 'waiting_dp';
    }

    public function isFinished()
    {
        return $this->game_status === 'finished';
    }
}
