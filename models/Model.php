<?php

class Model
{
    public PDO $connection;
    public string $table;
    public string $id;

    public function getOne()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $this->id;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Méthode permettant d'obtenir tous les enregistrements de la table choisie
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */
    public function findBySlug(string $slug)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `slug`='" . $slug . "'";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
