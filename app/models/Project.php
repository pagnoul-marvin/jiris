<?php
/*
namespace App\models;

use Core\Database;
use PDO;
use stdClass;

class Project extends Database
{
    protected string $table = 'projects';

    private PDO $connection;

    public function __construct()
    {
        parent::__construct(base_path('.env.local.ini'));
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function getPastProjects(int|string $id, string $model_name): array|false
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE $foreign_key = :id
        AND starting_at < current_timestamp
        ORDER BY name, created_at DESC
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getUpcomingProjects(int|string $id, string $model_name): array|false
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE $foreign_key = :id
        AND starting_at > current_timestamp
        ORDER BY name, created_at DESC
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCurrentProjects(int|string $id, string $model_name): array|false
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE $foreign_key = :id
        AND starting_at > current_timestamp
        AND ending_at < current_timestamp
        ORDER BY name, created_at DESC
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchProject(int|string $id): stdClass
    {
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE id = :id
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch();
    }

    public function fetchContacts(int|string $id): false|array
    {
        $sql = <<<SQL
        SELECT * from jiri.projects_contacts pc
        JOIN jiri.contacts c on pc.contact_id = c.id
        WHERE pc.project_id = :id
        ORDER BY c.name
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
}
*/

namespace App\models;

use Core\Database;
use PDO;
use stdClass;

class Project extends Database
{
    protected string $table = 'projects';

    private PDO $connection;

    public function __construct()
    {
        parent::__construct(base_path('.env.local.ini'));
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function getPassedProjects(int|string $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE $foreign_key = :id
        AND starting_at < current_timestamp
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getUpcomingProjects(int|string $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE $foreign_key = :id
        AND starting_at > current_timestamp
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getCurrentProjects(int|string $id, string $model_name): false|array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
        SELECT * from $this->table
        WHERE $foreign_key = :id
        AND starting_at < current_timestamp
        AND ending_at > current_timestamp
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchContacts(int|string $project_id, int|string $user_id, string $model_name, string $second_model_name): array|false
    {
        $foreign_key = "{$model_name}_id";
        $second_foreign_key = "{$second_model_name}_id";
        $sql = <<<SQL
        SELECT * from jiri.projects_contacts pc
        JOIN jiri.contacts c on pc.contact_id = c.id
        WHERE $foreign_key = :id
        AND $second_foreign_key = :second_id
        ORDER BY c.name
        SQL;

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $project_id);
        $statement->bindValue(':second_id', $user_id);
        $statement->execute();
        return $statement->fetchAll();
    }

}