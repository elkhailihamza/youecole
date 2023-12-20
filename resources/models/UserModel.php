<?php

require_once(__DIR__ . "/../config/db.php");

class UserModel extends database
{
    private $sql;
    protected $SessionManager;
    protected $page;
    public function __construct(SessionManager $SessionManager) {
        parent::__construct();
        $this->SessionManager = $SessionManager;
        if(isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }
    }
    public function loginUser($email)
    {
        $result = $this->findEmail($email);
        $row = $result;
        
        $this->SessionManager->setSession("user_id", $row['user_id']);
        $this->SessionManager->setSession("fname", $row['first_name']);
        $this->SessionManager->setSession("lname", $row['last_name']);
        $this->SessionManager->setSession("email", $row['email']);
        $this->SessionManager->setSession("role_id", $row['role_id']);

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
            $this->page = "dashboard";
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
            $this->page = "login";
            return true;
        } else {
            return false;
        }
    }
}