<?php
include(__DIR__ . "./includes/header.php");
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Apprenant Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Apprenant Welcome Screen</li>
    </ol>
    <?php
    $crud->userWelcomeText();
    $crud->getUserCurrentClassRoom();
    ?>
</div>
<?php
include(__DIR__ . "./includes/footer.php");
?>