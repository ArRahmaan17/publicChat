<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicChat extends Model
{
    use HasFactory;
    protected $fillable = ['message', 'id_user', 'message_time', 'message_date'];
    static function allChats()
    {
        return self::limit(10)->orderBy('id', 'DESC')->get()->toArray();
    }

    static function storeNewChat(array $chats)
    {
        return self::insert($chats);
    }
}
