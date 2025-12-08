<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'read_at',
        'admin_notes',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    /**
     * Check if message is unread
     */
    public function isUnread(): bool
    {
        return $this->status === 'unread';
    }

    /**
     * Mark as read
     */
    public function markAsRead(): void
    {
        $this->update([
            'status' => 'read',
            'read_at' => now(),
        ]);
    }
}
