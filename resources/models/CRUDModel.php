<?php

require_once(__DIR__ . "/../config/db.php");

class CRUDModel extends database
{
    private $sql;
    public function getFormateurs()
    {
        $this->sql = "SELECT 
        users.user_id, 
        users.first_name, 
        users.last_name, 
        users.email, 
        users.role_id, 
        roles.role_name 
    FROM 
        users 
    INNER JOIN 
        roles ON users.role_id = roles.role_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}