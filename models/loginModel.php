<?php

class loginModel extends Model
{
    public function existsUser($pseudo, $password)
    {
        $sql = $this->connection->query(
            "SELECT id FROM users WHERE user_name = '$pseudo' AND user_password = '$password'"
        );

        if (is_array($row = $sql->fetch())) {
            return $row['id'];
        } else {
            return null;
        }
    }

//	public function createUser()
//	{
//	}

//	public function retrievePassword()
//	{
//	}
}
