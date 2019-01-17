<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    $attended = get_attendance_attended2(3, 2);
    success('attended2', mysqli_fetch_all($attended, MYSQLI_ASSOC));
?>
