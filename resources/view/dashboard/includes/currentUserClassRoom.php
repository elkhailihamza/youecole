<div class="container d-flex justify-content-center flex-column">
    <h4 class="mt-5">Current Class: </h4>
    <?php
    if ($row) {
        ?>
        <div class="card ms-5" style="width: 18rem;">
            <img src="./public/assets/img/thumbnail.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">
                    <?= $row['class_name'] ?>
                </h5>
                <p class="card-text">
                    <?= $row['class_description'] ?>
                </p>
                <span>By:
                    <?= $row['first_name'] . ", " . $row['last_name'] ?>
                </span>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo 'No Assigned Class..';
    }
    ?>
</div>