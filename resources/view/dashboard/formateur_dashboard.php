<?php
include(__DIR__ . "./includes/header.php");
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Formateur Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Formateur Table</li>
    </ol>
    <div class="mb-4">
        <div class="container p-0" style="height: 400px; overflow: auto;">
            <table class="table table-bordered">
                <thead class="position-sticky bg-primary text-white" style="top: 0px;">
                    <tr>
                        <th>#</th>
                        <th class="col-3">First Name</th>
                        <th class="col-3">Last Name</th>
                        <th class="col-3">Email</th>
                        <th class="col-5">ClassRoom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $crud->showAllApprenants('normal');
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include(__DIR__ . "./includes/footer.php");
?>