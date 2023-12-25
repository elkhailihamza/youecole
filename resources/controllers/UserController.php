<?php
require_once(__DIR__ . "/../models/UserModel.php");
require_once(__DIR__ . "/../services/sessionManager.php");

class UserController
{
    private $userModel;
    private $session;
    public function __construct() {
        $this->session = new sessionManager();
        $this->userModel = new UserModel();
    }
    public function userLogin($email, $password)
    {
        if ($this->userModel->emailExists($email)) {
            if ($this->userModel->passMatches($email, $password)) {
                if ($this->userModel->loginUser($email)) {
                    switch($this->session->getSession("role_id")) {
                        case '4':
                            header("Location: ./index.php?page=admin_dashboard");
                            break;
                        case '3':
                            header("Location: ./index.php?page=formateur_dashboard");
                            break;
                        case '2':
                            header("Location: ./index.php?page=apprenant_dashboard");
                            break;
                        case '1':
                            header("Location: ./index.php?page=no-role");
                            break;
                        case '0':
                            header("Location: ./index.php?page=banned");
                            break;
                    }
                } else {
                    header("Location: ./index.php");
                }
            }
        } else {
            exit("Email or Password do not match!");
        }
    }
    public function userRegister($fname, $lname, $email, $pass, $confirmpass)
    {
        if (!$this->userModel->emailExists($email)) {
            if ($pass === $confirmpass) {
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                if ($this->userModel->registerUser($fname, $lname, $email, $hashedPass)) {
                    header("Location: ./index.php?page=login");
                } else {
                    exit("Error Register!");
                }
            } else {
                exit("Password does not match!");
            }
        } else {
            exit("Email already in use!");
        }
    }
    public function logUserOut()
    {
        if($this->userModel->logOutUser()) {
            header("Location: ./index.php?page=login");
        }
    }
}