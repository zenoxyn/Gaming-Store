<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'profile_picture',
        'role_user',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    // Relationships
    public function seller()
    {
        return $this->hasOne(Seller::class, 'id_user');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id_user');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Seller::class, 'id_user', 'id_seller');
    }

    public function buyerOrders()
    {
        return $this->hasMany(Order::class, 'id_buyer');
    }

    public function sellerOrders()
    {
        return $this->hasMany(Order::class, 'id_seller');
    }

    public function buyerReviews()
    {
        return $this->hasMany(Review::class, 'id_buyer');
    }

    public function sellerReviews()
    {
        return $this->hasMany(Review::class, 'id_seller');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'id_reporter');
    }

    public function buyerNegotiations()
    {
        return $this->hasMany(Negotiation::class, 'id_buyer');
    }

    public function sellerNegotiations()
    {
        return $this->hasMany(Negotiation::class, 'id_seller');
    }

    public function chatParticipants()
    {
        return $this->hasMany(ChatParticipant::class, 'id_user');
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'id_sender');
    }

    // Helper methods
    public function isBuyer()
    {
        return in_array($this->role_user, ['buyer', 'both']);
    }

    public function isSeller()
    {
        return in_array($this->role_user, ['seller', 'both']);
    }

    public function isAdmin()
    {
        return $this->role_user === 'admin';
    }
}
