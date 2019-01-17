<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();

    $attended = get_attendance_attended(3);
    success('attended', mysqli_fetch_all($attended, MYSQLI_ASSOC));
?>
