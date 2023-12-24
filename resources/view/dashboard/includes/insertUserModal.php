<?php
require_once (__DIR__ . "./../../../controllers/CRUDController.php");
$crud = new CRUDController();
?>
<div class="modal fade w-100" id="addUserModal<?= $row['class_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">Add Apprenants to Class: <?= $row['class_name'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="d-flex flex-column">
                    <?php
                    $type = 2;
                    $crud->showAllApprenants($type);
                    ?>
                    <input type="hidden" value="<?= $row['class_id'] ?>" name="class_id">
                    <div class="modal-footer justify-content-center mt-3">
                        <button class="btn btn-dark border-0" type="submit" name="submit" value="addToClass">Add Apprenant(s)</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>