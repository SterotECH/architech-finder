<?php

namespace App\Models;

class Message extends Model
{
    public int $id;
    public int $project_id;
    public string $message;
    public int $receiver_id;
    public int $sender_id;
    public string $sent_at;
    public string $read_at;
    public string $updated_at;

    protected static array $fields = [
        'id', 'project_id', 'message', 'receiver_id', 'sender_id', 'sent_at', 'read_at', 'updated_at'
    ];

    public static function getAllByProject()
    {
        return self::all();
    }
    /**
     * get all client messages by their id and project id
     *
     * @param int $id The Client ID
     * @param int $project_id The Project ID
     *
     * @return void
     */
    public static function getClientMessages(string | int $project_id)
    {
        return self::where('project_id', $project_id)->get();
    }

    public static function getMessages(): array
    {
        return self::all();
    }
}
