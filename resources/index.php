<?php
require(__DIR__ . "/./controllers/UserController.php");
require(__DIR__ . "/./controllers/pageController.php");
require(__DIR__ . "/./services/sessionManager.php");

$session = new sessionManager();
$session->startSession();

$user = new UserController($session);
$page = new pageController($session);

if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
    switch ($submit) {
        case 'ruser':
            extract($_POST);
            $user->userRegister($fname, $lname, $email, $pass, $confirmpass);
            break;
        case 'luser':
            extract($_POST);
            $user->userLogin($email, $pass);
            break;
        case 'logout':
            $user->userLogin($email, $pass);
            break;
    }
}

$page->currentPage();