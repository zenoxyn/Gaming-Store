<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_chat',
        'id_sender',
        'message',
        'attachment',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    // Relationships
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'id_sender');
    }

    // Auto-update chat and increment unread for other participants
    protected static function boot()
    {
        parent::boot();

        static::created(function ($message) {
            // Update last message in chat
            $message->chat->updateLastMessage($message->message);

            // Increment unread count for other participants
            $message->chat->participants()
                ->where('id_user', '!=', $message->id_sender)
                ->each(function ($participant) {
                    $participant->incrementUnread();
                });
        });
    }

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
