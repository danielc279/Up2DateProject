<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    $assignments = get_all_assignments_student(3);
    success('assignment', mysqli_fetch_all($assignments, MYSQLI_ASSOC));
?>
