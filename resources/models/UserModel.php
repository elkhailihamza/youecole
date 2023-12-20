<?php

require_once(__DIR__ . "/../config/db.php");

class UserModel extends database
{
    private $sql;
    protected $sessionManager;
    public function __construct(sessionManager $sessionManager) {
        parent::__construct();
        $this->sessionManager = $sessionManager;
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

        if(!empty($row)) {
            return true;
        } else {
            return false;
        }
    }
    public function findEmail($email)
    {
        $this->sql = "SELECT * FROM users WHERE email = :email;";
        $stmt = $this->connexion()->prepare($this->sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    public function emailExists($email)
    {

        $result = $this->findEmail($email);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function passMatches($email, $pass)
    {

        $result = $this->findEmail($email);
        $row = $result;

        if (password_verify($pass, $row['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUser($fname, $lname, $email, $pass)
    {
        $role_id = 1;
        $this->sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `role_id`) VALUES (:fname,:lname,:email,:pass,:role_id)";
        $stmt = $this->connexion()->prepare($this->sql);

        $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);
        $stmt->bindParam(":role_id", $role_id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}