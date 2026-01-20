<?php

namespace Oleh\AmDev\Models;

use Oleh\AmDev\core\base\Model;
use PDO;

class Task extends Model
{
    protected string $table = 'tasks';

    public int $id;

    public string $status;

    public string $user;

    public int $user_id;

    public string $created_at;

    public string $updated_at;

    public string $title;

    public string $description;

    public function insertTask(array $data): bool|int
    {

        $title = $data['title'];
        $user_id = $data['user_id'];
        $description = $data['description'];
        $status = 'ToDo';

        $created_at = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO `{$this->table}` SET `created_at` = :created_at,
                                                 `updated_at` = :created_at,
                                                 `status` = :status,
                                                 `user_id` = :user_id, 
                                                 `title` = :title, 
                                                 `description` = :description";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':created_at', $created_at, \PDO::PARAM_STR);

        $result->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);

        $result->bindParam(':status', $status, \PDO::PARAM_STR);

        $result->bindParam(':user_id', $user_id, \PDO::PARAM_INT);

        $result->bindParam(':title', $title, \PDO::PARAM_STR);

        $result->bindParam(':description', $description, \PDO::PARAM_STR);

        if (!$result->execute())
        {
            return false;
        }

        // Получаем id вставленной записи
        $insert_id = $this->pdo->connect->lastInsertId();

        return $insert_id;
    }

    public function getTasksByAutor(int $id): array|bool
    {

        $sql = "SELECT * FROM {$this->table} 
                WHERE `user_id` = :id";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_CLASS, 'Oleh\AmDev\Models\Task');

        $result->execute();

        $array = $result->fetchAll();

        if($array === false)
        {
            return false;
        }

        return $array;
    }

    public function getAllTasks(): array|bool
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.status, 
        {$this->table}.created_at, {$this->table}.updated_at, 
        {$this->table}.title, {$this->table}.description, users.email as user 
        FROM {$this->table} 
        JOIN users 
        ON {$this->table}.user_id=users.id";

        $result = $this->pdo->connect->prepare($sql);

        $result->setFetchMode(PDO::FETCH_CLASS, 'Oleh\AmDev\Models\Task');

        $result->execute();

        $array = $result->fetchAll();

        if($array === false)
        {
            return false;
        }

        return $array;
    }

    public function findTaskById(int $id)
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.status,         
        {$this->table}.title, {$this->table}.description, {$this->table}.created_at, {$this->table}.updated_at, users.email as user 
        FROM {$this->table} 
        JOIN users 
        ON {$this->table}.user_id=users.id 
        WHERE {$this->table}.id=:id";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_CLASS, 'Oleh\AmDev\Models\Task');

        $result->execute();

        $array = $result->fetch();

        if($array === false)
        {
            return false;
        }

        return $array;
    }

    public function updateStatus($data): bool
    {
        $id = $data['task_id'];
        $status = $data['status'];

        $updated_at = date('Y-m-d H:i:s');
        
        $sql = "UPDATE {$this->table} SET `status` = :status, `updated_at` = :updated_at WHERE `id` = :id";       

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->bindParam(':status', $status, \PDO::PARAM_STR);
        $result->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);

        if (!$result->execute())
        {
            return false;
        }

        return true;
    }
}