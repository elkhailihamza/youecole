<div class="modal fade" id="exampleModal<?= $row['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">Edit details N°:
                    <?= $row['user_id'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center container mb-3 mt-3">
                        <div class="form-floating mb-3">
                            <input class="form-control" value="<?= $row['first_name'] ?>" name="fname" type="text" required maxlength="225"
                                placeholder="first.name" />
                            <label>First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" value="<?= $row['last_name'] ?>" name="lname" type="text" required maxlength="225"
                                placeholder="last.name" />
                            <label for="inputEmail">Last Name</label>
                        </div>
                    </div>
                    <div class="mb-3 container">
                        <div class="form-floating mb-3">
                            <input class="form-control" value="<?= $row['email'] ?>" name="email" type="email" required maxlength="225"
                                placeholder="name@example.com" />
                            <label for="inputEmail">Email</label>
                        </div>
                    </div>
                    <div class="mb-3 container">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="role_id" required>
                                <option value="<?= $row['role_id'] ?>" selected hidden>
                                    <?= $row['role_name'] ?>
                                </option>
                                <option value="1">No Role</option>
                                <option value="2">Apprenant</option>
                                <option value="3">Formateur</option>
                                <option value="4">Administrateur</option>
                            </select>
                            <label>User Role</label>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $row['user_id'] ?>" name="user_id">
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-success border-0" type="submit" name="submit" value="edit">Edit
                            details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>