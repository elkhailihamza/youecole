<?php
require (__DIR__ . "/./controllers/UserController.php");
require (__DIR__ . "/./services/sessionManager.php");
$session = new sessionManager();
$session->startSession();

$user = new UserController($session);

if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
    switch($submit) {
        case 'ruser':
            extract($_POST);
            $user->userRegister($fname, $lname, $email, $pass, $confirmpass);
            break;
        case 'luser':
            extract($_POST);
            $user->userLogin($email, $pass);
            break;
    }
}

if (isset($_GET['identifier'])) {
    $identifier = $_GET['identifier'];
    switch ($identifier) {
        case 'login':
            include_once (__DIR__ . "/./view/login.php");
            break;
        case 'register':
            include_once (__DIR__ . "/./view/register.php");
            break;
        case 'dashboard':
            include_once (__DIR__ . "/./view/dashboard.php");
            break;
    }
} else {
    include_once (__DIR__ . "/./view/login.php");
}