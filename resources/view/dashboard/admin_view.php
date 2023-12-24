<?php
include(__DIR__ . "./includes/header.php");
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Table</li>
    </ol>
    <div class="mb-4">
        <div class="container p-0" style="height: 400px; overflow: auto;">
            <table class="table table-bordered">
                <thead class="position-sticky bg-primary text-white" style="top: 0px;">
                    <tr>
                        <th style="width: 45px;">#</th>
                        <th class="col-2">First Name</th>
                        <th class="col-2">Last Name</th>
                        <th class="col-2">Email</th>
                        <th class="col-2">ClassRoom</th>
                        <th class="col-2">Role</th>
                        <th style="width: 175px;">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $crud->showAllUsers();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include(__DIR__ . "./includes/footer.php");
?>