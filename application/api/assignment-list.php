<?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();
    get_input_stream($data);
    $id    = isset($data['id']) ? $data['id'] : '';


    $assignments = get_all_assignments_student($id);
    success('assignment', $assignments);
?>
