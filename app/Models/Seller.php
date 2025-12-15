<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'id_user',
        'legal_name',
        'id_card_number',
        'id_card_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'verification_status',
        'verified_at',
        'rating',
        'total_reviews',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_seller');
    }

    // Helper methods
    public function isVerified()
    {
        return $this->verification_status === 'verified';
    }

    public function isPending()
    {
        return $this->verification_status === 'pending';
    }
}
