<?php

require_once (__DIR__ . "/../config/db.php");

class UserModel extends database {
    private $sql;
    public function loginUser($email, $password) {
        $this->sql = "SELECT * FROM";
    }

    public function emailExists($email) {
        $this->sql = "SELECT * FROM users WHERE email = :email;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();

        if (!empty($result)) {  
            return true;
        } else {    
            return false;
        }
    }

    public function registerUser($fname, $lname, $email, $pass) {
        $role_id = 1;
        $this->sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `role_id`) VALUES (:fname,:lname,:email,:pass,:role_id)";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);
        $stmt->bindParam(":role_id", $role_id, PDO::PARAM_STR);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}