<?php

namespace App\Models;

use Core\Database;
use PDO;

class Attendance extends Database
{
    protected string $table = 'attendances';

    private PDO $connection;

    public function __construct()
    {
        parent::__construct(base_path('.env.local.ini'));
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function setRole(array $data): bool
    {
        $sql = <<<SQL
            UPDATE $this->table 
            SET role = :role
                WHERE jiri_id = :jiri_id
            AND contact_id = :contact_id
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('role', $data['role']);
        $statement->bindValue('jiri_id', $data['jiri_id']);
        $statement->bindValue('contact_id', $data['contact_id']);

        return $statement->execute();
    }
}