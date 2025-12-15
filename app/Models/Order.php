<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id_product',
        'id_buyer',
        'id_seller',
        'id_negotiation',
        'quantity',
        'original_price',
        'final_price',
        'platform_fee',
        'payment_method',
        'payment_status',
        'order_status',
        'delivery_info',
        'delivery_proof',
        'delivery_uploaded_at',
        'buyer_notes',
        'seller_notes',
        'completed_at',
        'canceled_at',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'original_price' => 'integer',
            'final_price' => 'integer',
            'platform_fee' => 'integer',
            'delivery_uploaded_at' => 'datetime',
            'completed_at' => 'datetime',
            'canceled_at' => 'datetime',
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

    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class, 'id_negotiation');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'id_order');
    }

    public function report()
    {
        return $this->hasOne(Report::class, 'id_order');
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class, 'id_order');
    }

    // Helper methods
    public function isPending()
    {
        return $this->order_status === 'pending';
    }

    public function isCompleted()
    {
        return $this->order_status === 'completed';
    }

    public function canBeReviewed()
    {
        return $this->isCompleted() && !$this->review;
    }

    public function getTotalAmount()
    {
        return $this->final_price + $this->platform_fee;
    }
}
