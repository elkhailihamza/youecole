<?php
$session = new sessionManager();
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
        if ($session->getSession("user_id") == $row['formateur_id']) {
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
                include(__DIR__ . "/./insertUserModal.php");
                ?>
                <button type="button"
                    class="btn btn-warning mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"
                    data-bs-toggle="modal" data-bs-target="#removeUserModal<?= $row['class_id'] ?>"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                </button>
                <?php
                include(__DIR__ . "/./removeUserModal.php");
                ?>
                <button type="button"
                    class="btn btn-primary mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"
                    data-bs-toggle="modal" data-bs-target="#viewUserModal<?= $row['class_id'] ?>"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </button>
                <?php
                include(__DIR__ . "/./viewUserModal.php");
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
                include(__DIR__ . "/./editClassModal.php");
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