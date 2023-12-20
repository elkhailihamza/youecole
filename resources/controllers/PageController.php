<?php

require_once(__DIR__ . "/../models/UserModel.php");
class pageController extends UserModel
{
    public function currentPage()
    {
        if (isset($this->page)) {
            switch ($this->page) {
                case 'login':
                    include_once(__DIR__ . "/../view/login.php");
                    break;
                case 'register':
                    include_once(__DIR__ . "/../view/register.php");
                    break;
                case 'dashboard':
                    include_once(__DIR__ . "/../view/dashboard/dashboard.php");
                    break;
                case 'logout':
                    include_once(__DIR__ . "/../view/dashboard/dashboard.php");
                    break;
            }
        } else {
            include_once(__DIR__ . "/../view/login.php");
        }
    }
}

