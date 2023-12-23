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
    public function showAllApprenants()
    {
        $this->filter = "apprenant";
        $this->result = $this->crudModel->getUsers($this->filter);
        $this->userTable();
    }
    public function showAllUsers()
    {
        $this->filter = null;
        $this->result = $this->crudModel->getUsers($this->filter);
        $this->userTable();
    }
    public function showAllClasses()
    {
        $this->result = $this->crudModel->getClasses();
        $this->classTable();
    }
    public function classTable()
    {
        if (!empty($this->result)) {
            foreach ($this->result as $k => $row) {

                ?>
                <div class="card flex-shrink-0" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $row['class_name'] ?> By:
                            <?= $row['first_name'] . " " . $row['last_name'] ?>
                        </h5>
                        <p class="card-text">
                            <?= $row['class_description'] ?>
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo 'No Classes Available at This Moment.';
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
                        <?php
                        if ($this->session->getSession("role_id") == 4) {
                            ?>
                            <td>
                                <div class="d-flex justify-content-around">
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
                                        data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['user_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                        </svg>
                                    </button>
                                    <?php
                                    include(__DIR__ . "/../view/dashboard/includes/editModal.php");
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
    public function insertClass($cname, $cdesc)
    {
        $formateur_id = $this->session->getSession("user_id");
        if ($this->crudModel->insertClass($cname, $cdesc, $formateur_id)) {
            header("Location: ./index.php?page=formateur_view");
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
        } else {
            exit("error");
        }
    }

}