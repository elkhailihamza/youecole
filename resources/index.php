<?php
require(__DIR__ . "/./controllers/UserController.php");
require(__DIR__ . "/./controllers/pageController.php");
require(__DIR__ . "/./controllers/CRUDController.php");

$session = new sessionManager();
$session->startSession();

$user = new UserController();
$page = new pageController();
$crud = new CRUDController();

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
        case 'edit':
            extract($_POST);
            $crud->editFormateur($user_id, $fname, $lname, $email, $role_id);
            break;
        case 'del':
            extract($_POST);
            $crud->delFormateur($user_id);
            break;
        case 'logout':
            $user->logUserOut();
            break;
    }
}

$page->currentPage();