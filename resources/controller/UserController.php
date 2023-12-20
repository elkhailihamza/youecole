<?php

require_once (__DIR__ . "/../model/UserModel.php");

class UserController extends UserModel {

    
    public function userLogin($aezzea, $ezaezaez) {

    } 

    public function userRegister($fname, $lname, $email, $pass, $confirmpass) {
        $emailExists = $this->emailExists($email);
        if(!$emailExists) {
            if($pass === $confirmpass) {
                if($this->registerUser($fname, $lname, $email, $pass)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                exit("Password does not match!");
            }
        } else {
            exit("Email already in use!");
        }
    }
}