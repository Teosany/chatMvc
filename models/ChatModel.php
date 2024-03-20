<?php

namespace App\models;

class ChatModel extends Model
{
	public function insertMessage(int $userId, int $roomId, string $message, string $color, $date): void
    {
        $query = $this->connection->query("INSERT INTO messages (msg_user_id, msg_room_id, msg_text, msg_color, msg_date) VALUES ('$userId', '$roomId', '$message', '$color', '$date')");
	}
    public function getMessages(): array
    {
        $query = $this->connection->query("SELECT * 
            FROM (SELECT msg_color, user_name, msg_text, m.id, msg_date FROM messages m LEFT JOIN users u ON msg_user_id = u.id WHERE msg_room_id=" . $this->id . " ORDER BY m.id DESC LIMIT 10) 
            sub ORDER BY sub.id");
        return $query->fetchAll();
    }
    public function updateUser($userId, $name): void
    {
        $this->connection->query("UPDATE users SET user_name = '$name' WHERE id = '$userId'");
    }
}
