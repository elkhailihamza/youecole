<?php

class pageController
{
    private $page;
    public function __construct()
    {
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }
    }
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
                case 'admin_dashboard':
                    include_once(__DIR__ . "/../view/dashboard/admin_dashboard.php");
                    break;
                case 'admin_view':
                    include_once(__DIR__ . "/../view/dashboard/admin_view.php");
                    break;
                case 'formateur_dashboard':
                    include_once(__DIR__ . "/../view/dashboard/formateur_dashboard.php");
                    break;
            }
        } else {
            include_once(__DIR__ . "/../view/login.php");
        }
    }
}

