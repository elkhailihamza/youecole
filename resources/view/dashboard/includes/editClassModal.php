<div class="modal fade" id="editClassModal<?= $row['class_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">Edit classroom: 
                    <?= $row['class_name'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="d-flex flex-column">
                    <div class="mb-3 container">
                        <div class="form-floating mb-3">
                            <input class="form-control" name="cname" type="text" placeholder="Edit Class Name.." required
                                value="<?= $row['class_name'] ?>" maxlength="125" />
                            <label>Class Room Name</label>
                        </div>
                    </div>
                    <div class="mb-3 container">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Edit Description.." name="cdesc" maxlength="300" required 
                                style="resize: none; height: 250px;"><?= $row['class_description'] ?></textarea>
                            <label>Description</label>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $row['class_id'] ?>" name="class_id">
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-success border-0" type="submit" name="submit" value="edit">Edit
                            ClassRoom</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>