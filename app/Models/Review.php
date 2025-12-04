<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'id_order',
        'id_buyer',
        'id_seller',
        'id_product',
        'rating',
        'review',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'id_buyer');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'id_seller');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
