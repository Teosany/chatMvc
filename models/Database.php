<?php

class Database extends PDO
{
    private string $DB_HOST = 'localhost';
    private string $DB_USER = 'root';
    private string $DB_PASS = 'root';
    private string $DB_NAME = 'messagerie';
    public ?PDO $database = null;

    public function __construct()
    {
        if (empty($_ENV["DB_HOST"])) {
            try {
                if ($this->database === null) {
                    $this->database = parent::__construct("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
                }
            } catch (\PDOException $e) {
                echo "Erreur de connection : " . $e->getMessage();
            }
        }
        if (!empty($_ENV["DB_HOST"])) {
            try {
                if ($this->database === null) {
                    $this->database = parent::__construct("mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASS"]);
                }
            } catch (\PDOException $e) {
                echo "Erreur de connection : " . $e->getMessage();
            }
        }
        return $this->database;
    }
}