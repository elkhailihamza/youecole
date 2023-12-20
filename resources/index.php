<?php
require (__DIR__ . "/./controller/UserController.php");
$user = new UserController();

if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
    switch($submit) {
        case 'ruser':
            extract($_POST);
            if($user->userRegister($fname, $lname, $email, $pass, $confirmpass)) {
                include(__DIR__ . "/./view/login.php");
            }
            break;
        case 'luser':
            extract($_POST);
            $user->userLogin($email, $pass);
            break;
    }
} else {
    include (__DIR__ . "/./view/register.php");
}