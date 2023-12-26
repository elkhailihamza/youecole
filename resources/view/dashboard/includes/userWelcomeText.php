<?php
$session = new sessionManager();
?>
<div class="container text-center mt-4">
    <div>
        <h2><u>Welcome</u>:
            <?= $session->getSession("fname") . ", " . $session->getSession("lname"); ?>
        </h2>
    </div>
</div>