<?php

require_once(__DIR__ . "/../config/db.php");

class CRUDModel extends database
{
    private $sql;
    public function getUsers($filter)
    {
        if (isset($filter)) {
            $this->sql = "SELECT 
            users.user_id, 
            users.first_name, 
            users.last_name, 
            users.email,
            users.role_id, 
            roles.role_name,
            users.class_id,
            classes.class_name
        FROM 
            users 
        INNER JOIN 
            roles ON users.role_id = roles.role_id
        LEFT JOIN 
            classes ON users.class_id = classes.class_id WHERE roles.role_id = :role_id ORDER BY classes.class_name DESC;";
        } else {
            $this->sql = "SELECT 
            users.user_id, 
            users.first_name, 
            users.last_name, 
            users.email,
            users.role_id, 
            roles.role_name,
            classes.class_name
        FROM 
            users 
        INNER JOIN 
            roles ON users.role_id = roles.role_id
        LEFT JOIN 
            classes ON users.class_id = classes.class_id;";
        }
        $stmt = $this->connexion()->prepare($this->sql);
        if (isset($filter)) {
            $stmt->bindParam(":role_id", $filter, PDO::PARAM_INT);
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

        return $stmt->execute() ? true : false;
    }
    public function delUser($user_id)
    {
        $this->sql = "DELETE FROM `users` WHERE user_id = :user_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }
    public function addApprenantToClassRoom($class_id, $user_id)
    {
        $this->sql = "UPDATE `users` SET `class_id`=:class_id WHERE user_id = :user_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":class_id", $class_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }
    public function getAllApprenantsinClass($class_id)
    {
        $this->sql = "SELECT users.first_name, users.last_name, roles.role_name FROM `users` INNER JOIN roles ON users.role_id = roles.role_id WHERE class_id = :class_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":class_id", $class_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getClassRooms()
    {
        $this->sql = "SELECT classes.class_id, classes.formateur_id, classes.class_name, classes.class_description, users.first_name, users.last_name FROM classes JOIN users ON classes.formateur_id = users.user_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insertClassRoom($cname, $cdesc, $formateur_id)
    {
        $this->sql = "INSERT INTO `classes`(`formateur_id`, `class_name`, `class_description`) VALUES (:formateur, :cname, :cdesc);";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":formateur", $formateur_id, PDO::PARAM_INT);
        $stmt->bindParam(":cname", $cname, PDO::PARAM_STR);
        $stmt->bindParam(":cdesc", $cdesc, PDO::PARAM_STR);

        return $stmt->execute() ? true : false;
    }
    public function editClassRoom($class_id, $cname, $cdesc)
    {
        $this->sql = "UPDATE `classes` SET `class_name`=:cname,`class_description`=:cdesc WHERE class_id = :class_id;";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":cname", $cname, PDO::PARAM_STR);
        $stmt->bindParam(":cdesc", $cdesc, PDO::PARAM_STR);
        $stmt->bindParam(":class_id", $class_id, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }
    public function delClassRoom($class_id)
    {
        $this->sql = "DELETE FROM `classes` WHERE class_id = :class_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":class_id", $class_id, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
    }
    public function getUserCurrentClassRoom($user_id)
    {
        $this->sql = "SELECT
        classes.class_id,
        formateur.first_name,
        formateur.last_name,
        classes.class_name,
        classes.class_description
    FROM
        users
    INNER JOIN classes ON users.class_id = classes.class_id
    LEFT JOIN users AS formateur ON formateur.user_id = classes.formateur_id
    WHERE
        users.user_id = :user_id;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}