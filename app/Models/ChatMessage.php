<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'menage_id',
        'user_id',
        'message',
    ];

    /**
     * Method to get the chat
     */
    public function chat()
    {
        return $this->belongsTo(MenageChat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}