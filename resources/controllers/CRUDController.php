<?php

require(__DIR__ . "/../models/CRUDModel.php");

class CRUDController
{
    private $crudModel;
    private $session;
    private $result;
    private $filter;
    public function __construct()
    {
        $this->session = new sessionManager();
        $this->crudModel = new CRUDModel();

    }
    public function userWelcomeText()
    {
        include(__DIR__ . "/../view/dashboard/includes/userWelcomeText.php");
    }
    public function getUserCurrentClassRoom()
    {
        $user_id = $this->session->getSession("user_id");
        $row = $this->crudModel->getUserCurrentClassRoom($user_id);
        include(__DIR__ . "/../view/dashboard/includes/currentUserClassRoom.php");
    }
    public function getUsers($filter)
    {
        return $this->crudModel->getUsers($filter);
    }
    public function showAllUsers()
    {
        $this->filter = null;
        $this->result = $this->getUsers($this->filter);
        $this->userTable();
    }
    public function showAllApprenants()
    {
        $this->result = $this->getUsers(2);
        $this->userTable();
    }
    public function editUser($user_id, $fname, $lname, $email, $role_id)
    {
        if ($this->crudModel->editUser($user_id, $fname, $lname, $email, $role_id)) {
            header("Location: ./index.php?page=admin_view");
        }
    }
    public function delUser($user_id)
    {
        if ($this->crudModel->delUser($user_id)) {
            header("Location: ./index.php?page=admin_view");
        }
    }
    public function getApprenantsfromClass($class_id, $type)
    {
        ($type == 1) ? $this->result = $this->getUsers(2) : $this->result = $this->crudModel->getApprenantsfromClass($class_id);
        return $this->showReadyApprenants($type);
    }
    public function showReadyApprenants($type)
    {
        if (!empty($this->result)) {
            $i = 0;
            if ($type == 1) {
                foreach ($this->result as $row) {
                    if ($row['class_id'] == null) {
                        $i++;
                        include(__DIR__ . "/../view/dashboard/includes/allApprenantsInClass.php");
                    }
                }
            } else {
                foreach ($this->result as $row) {
                    $i++;
                    include(__DIR__ . "/../view/dashboard/includes/allApprenantsInClass.php");
                }
            }
            return ($i == 0) ? false : true;
        }
    }

    public function addApprenantToClassRoom($student, $class_id)
    {
        if (isset($student) && is_array($student)) {
            foreach ($student as $s) {
                $this->crudModel->addApprenantToClassRoom($class_id, $s);
            }
            header("Location: ./index.php?page=formateur_view");
        } else {
            header("Location: ./index.php?page=formateur_view");
        }
    }
    public function rmApprenantToClassRoom($student)
    {
        if (isset($student) && is_array($student)) {
            foreach ($student as $s) {
                $this->crudModel->rmApprenantToClassRoom($s);
            }
            header("Location: ./index.php?page=formateur_view");
        } else {
            header("Location: ./index.php?page=formateur_view");
        }
    }
    public function userTable()
    {
        if (!empty($this->result)) {
            $i = 0;
            foreach ($this->result as $row) {
                if ($this->session->getSession("user_id") === $row['user_id']) {
                    continue;
                } else {
                    include(__DIR__ . "/../view/dashboard/includes/userTable.php");
                }
            }
        } else {
            echo 'EMPTY';
        }
    }
    public function showAllClassRooms()
    {
        $this->result = $this->crudModel->getClassRooms();
        $this->classRoomTable();
    }
    public function insertClassRoom($cname, $cdesc)
    {
        $formateur_id = $this->session->getSession("user_id");
        if ($this->crudModel->insertClassRoom($cname, $cdesc, $formateur_id)) {
            header("Location: ./index.php?page=formateur_view");
        }
    }
    public function editClassRoom($class_id, $cname, $cdesc)
    {
        if ($this->crudModel->editClassRoom($class_id, $cname, $cdesc)) {
            header("Location: ./index.php?page=formateur_view");
        }
    }
    public function delClassRoom($class_id)
    {
        if ($this->crudModel->delClassRoom($class_id)) {
            header("Location: ./index.php?page=formateur_view");
        }
    }
    public function classRoomTable()
    {
        if (!empty($this->result)) {
            foreach ($this->result as $row) {
                include(__DIR__ . "/../view/dashboard/includes/card.php");
            }
        } else {
            echo 'No Classes Available at This Moment.';
        }
    }
}