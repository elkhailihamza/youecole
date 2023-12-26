<div class="d-flex justify-content-between">
    <span>
        <?= $i . ") " . $row['first_name'] . " " . $row['last_name'] ?>
    </span>
    <span>
        <?= $row['role_name'] ?>
        <?php
        if ($type != 3) {
            ?>
            <input type="checkbox" name="student[]" value="<?= $row['user_id'] ?>" />
            <?php
        }
        ?>
    </span>
</div>