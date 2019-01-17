<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    $attended = get_attendance_attended1(3, 1);
    success('attended1', mysqli_fetch_all($attended, MYSQLI_ASSOC));
?>
