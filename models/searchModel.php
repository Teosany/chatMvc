<?php

class searchModel extends Model
{
    public function searchMessages($search): array
    {
        $query = $this->connection->query("
SELECT * FROM messages m 
JOIN users u ON m.msg_user_id = u.id
JOIN rooms r ON r.id = m.msg_room_id WHERE MATCH(msg_text) AGAINST('$search')");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}