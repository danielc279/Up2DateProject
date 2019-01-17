<?php
    // This file will be used to process the add shows form.
    include 'libraries/form.php';

    include 'libraries/database.php';
    include 'libraries/login-check.php';

    // 1. check that the form has been sent.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        exit('You have no access to this page.');
    }


    // 2. store the form data in case of any errors.
	  set_formdata($_POST);
    $date     = $_POST['attendance-date'];
    $subject  = $_POST['attendance-subject'];
    $user_id  = $_POST['attendance-id'];
    $attendance_list = $_POST['attendance-attended'];

    $check = add_attendance($date, $subject, $attendance_list);
    if (!$check)
    {
        exit("The query was unsuccessful.");
    }

    if ($has_errors)
    {
        redirect('attendence-update');
    }

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('attendance-update');

?>
