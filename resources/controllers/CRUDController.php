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
        ?>
        <div class="container text-center mt-4">
            <div>
                <h2><u>Welcome</u>:
                    <?= $this->session->getSession("fname") . ", " . $this->session->getSession("lname"); ?>
                </h2>
            </div>
        </div>
        <?php
    }
    public function getUserCurrentClassRoom()
    {
        $user_id = $this->session->getSession("user_id");
        $row = $this->crudModel->getUserCurrentClassRoom($user_id);
        ?>
        <div class="container d-flex justify-content-center flex-column">
            <h4 class="mt-5">Current Class: </h4>
            <?php
            if ($row) {
                ?>
                <div class="card ms-5" style="width: 18rem;">
                    <img src="./public/assets/img/thumbnail.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $row['class_name'] ?>
                        </h5>
                        <p class="card-text">
                            <?= $row['class_description'] ?>
                        </p>
                        <span>By: <?= $row['first_name'] . ", " . $row['last_name'] ?></span>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <h6 class="ms-5">No Assigned Class..</h6>
                <?php
            }
            ?>
        </div>
        <?php
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
    public function showAllApprenants($type)
    {
        $this->filter = 2;
        $this->result = $this->getUsers($this->filter);
        if ($type == 1) {
            $this->userTable();
        } else if ($type == 2) {
            $this->showReadyApprenants();
        }
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
    public function showReadyApprenants()
    {
        if (!empty($this->result)) {
            $i = 0;
            foreach ($this->result as $row) {
                if ($row['class_id'] == null) {
                    $i++;
                    ?>
                    <div class="d-flex justify-content-between">
                        <span>
                            <?= $i . ") " . $row['first_name'] . " " . $row['last_name'] ?>
                        </span>
                        <span>
                            <?= $row['role_name'] ?>
                            <input type="checkbox" name="student[]" value="<?= $row['user_id'] ?>" />
                        </span>
                    </div>
                    <?php
                }
            }
        }
    }
    public function addApprenantToClassRoom($student, $class_id)
    {
        if (isset($student) && is_array($student)) {
            foreach ($student as $s) {
                $this->crudModel->addApprenantToClassRoom($class_id, $s);
            }
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
                    ?>
                    <tr>
                        <th scope="row">
                            <?= ++$i ?>
                        </th>
                        <td>
                            <?= $row['first_name'] ?>
                        </td>
                        <td>
                            <?= $row['last_name'] ?>
                        </td>
                        <td>
                            <?= $row['email'] ?>
                        </td>
                        <td>
                            <?php
                            echo (isset($row['class_name'])) ? $row['class_name'] : 'NONE';
                            ?>
                        </td>
                        <?php
                        if ($this->session->getSession("role_id") == 4) {
                            ?>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <h6>
                                        <?= $row['role_name'] ?>
                                    </h6>
                                    <h6>
                                        [
                                        <?= $row['role_id'] ?>]
                                    </h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <button type="button"
                                        class="btn btn-warning mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="btn btn-success mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#editUserModal<?= $row['user_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                        </svg>
                                    </button>
                                    <?php
                                    include(__DIR__ . "/../view/dashboard/includes/editUserModal.php");
                                    ?>
                                    <form method="post">
                                        <input type="hidden" value="<?= $row['user_id'] ?>" name="user_id">
                                        <button type="submit" value="del" name="submit"
                                            class="btn btn-danger mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <td>
                EMPTY
            </td>
            <?php
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

                ?>
                <div class="card flex-shrink-0" style="width: 18rem;">
                    <img src="./public/assets/img/thumbnail.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $row['class_name'] ?>
                        </h5>
                        <p class="card-text">
                            <?= $row['class_description'] ?>
                        </p>
                        <?php
                        if ($this->session->getSession("user_id") == $row['formateur_id']) {
                            ?>
                            <div class="d-flex gap-2">
                                <button type="button"
                                    class="btn btn-dark mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#addUserModal<?= $row['class_id'] ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                </button>
                                <?php
                                include(__DIR__ . "/../view/dashboard/includes/insertUserModal.php");
                                ?>
                                <button type="button"
                                    class="btn btn-success mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#editClassModal<?= $row['class_id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                    </svg>
                                </button>
                                <?php
                                include(__DIR__ . "/../view/dashboard/includes/editClassModal.php");
                                ?>
                                <form method="post">
                                    <input type="hidden" value="<?= $row['class_id'] ?>" name="class_id">
                                    <button type="submit" value="del" name="submit"
                                        class="btn btn-danger mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                        By:
                        <?= $row['first_name'] . " " . $row['last_name'] ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo 'No Classes Available at This Moment.';
        }
    }
}