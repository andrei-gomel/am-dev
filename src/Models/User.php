<?php

namespace Oleh\AmDev\Models;

use Oleh\AmDev\core\base\Model;
use PDO;

class User extends Model
{
    public string $table = 'users';

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    public function getUser(array $data): object|bool
    {
        $sql = "SELECT `id`, `email` FROM {$this->table} 
                WHERE `email` = :email AND `password` = :password";

        $email = $data['email'];
        
        $password = $data['password'];

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':email', $email, \PDO::PARAM_STR);

        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        $result->setFetchMode(PDO::FETCH_CLASS, 'Oleh\AmDev\Models\User');

        $result->execute();

        $array = $result->fetch();

        if($array === false)
        {
            return false;
        }

        return $array;
    }

    public function insertUser(array $data): bool|int
    {

        $email = $data['email'];
        $password = $data['password'];

        $created_at = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO `{$this->table}` SET `email` = :email, 
                                                 `password` = :password, 
                                                 `created_at` = :created_at";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':email', $email, \PDO::PARAM_STR);

        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        $result->bindParam(':created_at', $created_at, \PDO::PARAM_STR);

        if (!$result->execute())
        {
            return false;
        }

        // Получаем id вставленной записи
        $insert_id = $this->pdo->connect->lastInsertId();

        return $insert_id;
    }
}
