<?php
include(__DIR__ . "./includes/admin_header.php");
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Table</li>
    </ol>
    <div class="mb-4">
        <div class="container" style="height: 400px; overflow: auto;">
            <table class="table table-bordered">
                <thead class="position-sticky bg-primary text-white" style="top: 0px;">
                    <tr>
                        <th>#</th>
                        <th class="col-2">First Name</th>
                        <th class="col-2">Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 125px;">Controls</th>
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
include(__DIR__ . "./includes/admin_footer.php");