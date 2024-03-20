<?php

namespace App\models;

class Model
{
    public ?\PDO $connection = null;
    public string $table;
    public int $id;

    public function getOne()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $this->id;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Retourne un article en fonction de son slug
     */
    public function findBySlug(string $slug)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `slug`='" . $slug . "'";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}
