<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatParticipant extends Model
{
    protected $fillable = [
        'id_chat',
        'id_user',
        'unread_count',
    ];

    protected function casts(): array
    {
        return [
            'unread_count' => 'integer',
        ];
    }

    // Relationships
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Helper methods
    public function incrementUnread()
    {
        $this->increment('unread_count');
    }

    public function resetUnread()
    {
        $this->update(['unread_count' => 0]);
    }

    public function hasUnread()
    {
        return $this->unread_count > 0;
    }
}
