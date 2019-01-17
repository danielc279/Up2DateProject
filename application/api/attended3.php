<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    $attended = get_attendance_attended3(3, 3);
    success('attended3', mysqli_fetch_all($attended, MYSQLI_ASSOC));
?>
