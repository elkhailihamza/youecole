<?php
include(__DIR__ . "./includes/header.php");
include(__DIR__ . "./includes/insertModal.php");
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Formateur Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Formateur Class Rooms</li>
    </ol>
    <div class="mb-4">
        <div class="row">
            <div class="container d-flex justify-content-end">
                <button type="button"
                    class="btn btn-primary mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3h18v18H3zM12 8v8m-4-4h8" />
                    </svg>
                </button>
            </div>
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Classes
                    </div>
                    <div class="card-body">
                        <?php
                        $crud->showAllClasses();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(__DIR__ . "./includes/footer.php");
?>