<?php

require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>
<p>Welcome (users) <?= current_user() ?> <a href="logout.php">Logout</a></p>

<div>
    <?php
        $test=$_SESSION['is_admin'];
        echo $test;
        echo $_SESSION['username'];
        echo $_SESSION['user_id'];
    ?>
</div>

<?php view('footer') ?>