<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'id_product',
        'id_order',
        'last_message',
        'last_message_at',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function participants()
    {
        return $this->hasMany(ChatParticipant::class, 'id_chat');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'id_chat');
    }

    // Helper methods
    public function getParticipantUsers()
    {
        return User::whereIn('id', $this->participants()->pluck('id_user'))->get();
    }

    public function getOtherParticipant($userId)
    {
        return $this->participants()->where('id_user', '!=', $userId)->first();
    }

    public function updateLastMessage($message)
    {
        $this->update([
            'last_message' => $message,
            'last_message_at' => now(),
        ]);
    }
}
