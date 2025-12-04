<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_wallet',
        'id_order',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'balance_before' => 'integer',
            'balance_after' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    // Relationships
    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'id_wallet');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
}
