<?php

require_once(__DIR__ . "/../config/db.php");
include_once (__DIR__ . "/../services/sessionManager.php");

class UserModel extends database
{
    private $sql;
    private $sessionManager;
    public function __construct()
    {
        parent::__construct();
        $this->sessionManager = new sessionManager();
    }
    public function loginUser($email)
    {
        $result = $this->findEmail($email);
        $row = $result;

        $this->sessionManager->setSession("user_id", $row['user_id']);
        $this->sessionManager->setSession("fname", $row['first_name']);
        $this->sessionManager->setSession("lname", $row['last_name']);
        $this->sessionManager->setSession("email", $row['email']);
        $this->sessionManager->setSession("role_id", $row['role_id']);

        return !empty($row) ? true : false;
    }
    public function findEmail($email)
    {
        $this->sql = "SELECT * FROM users WHERE email = :email;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function emailExists($email)
    {
        $result = $this->findEmail($email);
        return !empty($result) ? true : false;
    }

    public function passMatches($email, $pass)
    {

        $result = $this->findEmail($email);
        $row = $result;

        return password_verify($pass, $row['password']) ? true : false;
    }

    public function registerUser($fname, $lname, $email, $pass)
    {
        $role_id = 1;
        $this->sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `role_id`, `class_id`) VALUES (:fname, :lname, :email, :pass, :role_id, null)";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);
        $stmt->bindParam(":role_id", $role_id, PDO::PARAM_STR);
        
        return $stmt->execute() ? true : false;
    }

    public function logOutUser()
    {
        $this->sessionManager->destroySession();
        return true;
    }
}