<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    $subject = get_attendance_subject(3);
    success('subject', mysqli_fetch_all($subject, MYSQLI_ASSOC));
?>
