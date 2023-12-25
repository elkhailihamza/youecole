<?php
require_once(__DIR__ . "./../../../controllers/CRUDController.php");
$crud = new CRUDController();
?>
<div class="modal fade w-100" id="viewUserModal<?= $row['class_id'] ?>" tabindex="-1"
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
                <div style="height: 450px; overflow: auto;">
                    <?php
                    $result = $crud->getApprenantsinClass($row['class_id']);
                    echo (!$result) ? 'No Apprenant here..' : '' ;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>