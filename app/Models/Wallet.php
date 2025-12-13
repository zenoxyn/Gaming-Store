<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'id_user',
        'balance',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'integer',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'id_wallet');
    }

    // Helper methods
    public function addBalance($amount, $type, $description = null, $orderId = null)
    {
        $balanceBefore = $this->balance;
        $this->balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'id_order' => $orderId,
            'type' => $type,
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance,
            'description' => $description,
        ]);
    }

    public function deductBalance($amount, $type, $description = null, $orderId = null)
    {
        return $this->addBalance(-$amount, $type, $description, $orderId);
    }

    public function holdDeposit($amount, $description = null)
    {
        return $this->deductBalance($amount, 'deposit_hold', $description);
    }

    public function releaseDeposit($amount, $description = null)
    {
        return $this->addBalance($amount, 'deposit_release', $description);
    }

    public function receivePenalty($amount, $description = null)
    {
        return $this->addBalance($amount, 'penalty', $description);
    }

    public function hasBalance($amount)
    {
        return $this->balance >= $amount;
    }
}
