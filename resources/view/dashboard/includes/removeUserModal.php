<?php
require_once(__DIR__ . "./../../../controllers/CRUDController.php");
$crud = new CRUDController();
?>
<div class="modal fade w-100" id="removeUserModal<?= $row['class_id'] ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">All Apprenants in Class:
                    <?= $row['class_name'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 500px;">
                <form method="post" class="d-flex flex-column justify-content-between" style="height: 475px;">
                    <div style="height: 450px; overflow: auto;">
                        <?php
                        $result = $crud->getApprenantsfromClass($row['class_id'], 2);
                        ?>
                    </div>
                    <?php
                    if (!$result) {
                        ?>
                        <div class="container text-center">
                            <h4>No one to remove..</h4>
                        </div>
                        <?php
                    } else {
                        ?>
                        <input type="hidden" value="<?= $row['class_id'] ?>" name="class_id">
                        <div class="modal-footer justify-content-center mt-3">
                            <button class="btn btn-warning text-white border-0" type="submit" name="submit"
                                value="removeFromClass">Remove</button>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>