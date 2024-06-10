<?php

namespace App\Models;

use Core\Database;
use PDO;
use stdClass;

class User extends Database
{
    protected string $table = 'users';

    private PDO $connection;

    public function __construct()
    {
        parent::__construct(base_path('.env.local.ini'));
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function findByEmail(string $email): bool|stdClass
    {
        $sql = <<<SQL
                SELECT * FROM $this->table 
                         WHERE email = :email  
        SQL;
        $statement = $this->connection->prepare($sql);
        $statement->execute(['email' => $email]);

        return $statement->fetch();
    }
}
