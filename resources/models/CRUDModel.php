<?php

require_once(__DIR__ . "/../config/db.php");

class CRUDModel extends database
{
    private $sql;
    public function getUsers($filter)
    {
        if (isset($filter) && $filter = 'apprenant') {
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
            roles ON users.role_id = roles.role_id WHERE roles.role_name IN (:apprenant)";
        } else {
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
        }
        $stmt = $this->connexion()->prepare($this->sql);
        if(isset($filter)) {
            $stmt->bindParam(":apprenant", $filter, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function editUser($user_id, $fname, $lname, $email, $role_id)
    {
        $this->sql = "UPDATE `users` SET `first_name`=:fname,`last_name`=:lname,`email`=:email,`role_id`=:role_id WHERE user_id = :user_id;";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delUser($user_id)
    {
        $this->sql = "DELETE FROM `users` WHERE user_id = :user_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}