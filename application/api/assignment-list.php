<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();
    check_login_auth() or error("You have no permission to be here.");

    $assignments = get_all_assignments_student();
    success('assignments', mysqli_fetch_all($assignments, MYSQLI_ASSOC));
?>
