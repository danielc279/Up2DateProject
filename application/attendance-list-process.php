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
    $date = $_GET['attendance-date'];
    $subject = $_GET['attendance-subject'];
    // 3. retrieve the variables from $_POST.
    $id           = $_POST['attendance-id'];
    $attended       = $_POST['attendance-attended'];


    // we'll use a boolean to determine if we have errors on the page.
    $has_errors = FALSE;

    if ($has_errors)
    {
        redirect('assignments-edit', ['id' => $id]);
    }

    // 6. Insert the data in the table.
    // since the function will return a number, we can check it
    // to see if the query worked.
    $check = add_attendance($date, $subject, $id, $attended);
    if (!$check)
    {
        exit("The query was unsuccessful.");
    }

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('assignments-list');

?>
