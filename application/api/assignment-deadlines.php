<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    // $id = $_GET['id'];
    // $deadlines = get_all_deadlines_for_assignment($id);

    $assignments = get_all_assignments_student(2);
    success('assignment', mysqli_fetch_all($assignments, MYSQLI_ASSOC));
?>
