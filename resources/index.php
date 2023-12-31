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
        case 'insertClass':
            extract($_POST);
            $crud->insertClassRoom($cname, $cdesc);
            break;
        case 'addToClass':
            extract($_POST);
            $crud->addApprenantToClassRoom($student, $class_id);
            break;
        case 'edit':
            extract($_POST);
            if(isset($user_id)) {
                $crud->editUser($user_id, $fname, $lname, $email, $role_id);
            } else if (isset($class_id)) {
                $crud->editClassRoom($class_id, $cname, $cdesc);
            }
            break;
        case 'del':
            extract($_POST);
            if(isset($user_id)) {
                $crud->delUser($user_id);
            } else if (isset($class_id)) {
                $crud->delClassRoom($class_id);
            }
            break;
        case 'logout':
            $user->logUserOut();
            break;
    }
}

$page->currentPage();