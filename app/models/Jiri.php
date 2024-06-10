<?php

namespace App\Models;

use Core\Database;
use PDO;

class Jiri extends Database
{
    protected string $table = 'jiris';

    private PDO $connection;

    public function __construct()
    {
        parent::__construct(base_path('.env.local.ini'));
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function upcomingBelongingTo(string|int $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
                SELECT * FROM $this->table
                         WHERE $foreign_key = :id   
                               AND starting_at > current_timestamp
                SQL;
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function pastBelongingTo(string|int $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
                SELECT * FROM $this->table
                         WHERE $foreign_key = :id   
                               AND starting_at < current_timestamp
                SQL;
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchStudents(string|int $id): false|array
    {
        return $this->fetchContacts($id, 'student');
    }

    public function fetchContacts(string|int $id, ?string $role = ''): false|array
    {
        $role_constraints = '';

        if (in_array($role, ['student', 'evaluator'])) {
            $role_constraints = 'AND role = :role';
        }

        $sql = <<<SQL
            SELECT * FROM attendances
            LEFT JOIN jiri.contacts c on attendances.contact_id = c.id
            WHERE jiri_id = :id
            $role_constraints
            ORDER BY c.name;
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        if ($role_constraints) {
            $statement->bindValue(':role', $role);
        }
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchEvaluators(string|int $id): false|array
    {
        return $this->fetchContacts($id, 'evaluator');
    }
}