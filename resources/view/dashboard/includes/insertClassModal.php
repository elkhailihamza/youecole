<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">Add ClassRoom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="d-flex flex-column">
                    <div class="mb-3 container">
                        <div class="form-floating mb-3">
                            <input class="form-control" name="cname" type="text" placeholder="edit fname" maxlength="125" required/>
                            <label>Class Room Name</label>
                        </div>
                    </div>
                    <div class="mb-3 container">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="cdesc" maxlength="300" required
                                style="resize: none; height: 250px;"></textarea>
                            <label>Description</label>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center align-items-center">
                        <button class="btn btn-primary border-0" type="submit" name="submit" value="insertClass">
                            Add ClassRoom
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>