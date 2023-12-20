<?php

require_once(__DIR__ . "/../models/UserModel.php");

class UserController extends UserModel
{
    public function userLogin($email, $password)
    {
        if ($this->emailExists($email)) {
            if ($this->passMatches($email, $password)) {
                $row = $this->loginUser($email);
                if($this->loginUser($email)) {
                    include_once (__DIR__ . "./../view/dashboard/dashboard.php");
                } else {
                    exit("Error Login!");
                }
            }
        } else {
            exit("Email or Password do not match!");
        }
    }

    public function userRegister($fname, $lname, $email, $pass, $confirmpass)
    {
        if (!$this->emailExists($email)) {
            if ($pass === $confirmpass) {
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                if ($this->registerUser($fname, $lname, $email, $hashedPass)) {
                    return true;
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
}