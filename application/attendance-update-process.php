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

    // 3. retrieve the variables from $_POST.
    $date       = $_POST['attendance-date'];
    $subject    = $_POST['attendance-subject'];


    // we'll use a boolean to determine if we have errors on the page.
    $has_errors = FALSE;

    // 4. check the inputs that are required.
    if (empty($date))
    {
    	$has_errors = set_error('assignment-name', 'The name field is required.');
    }

    if (empty($subject))
    {
    	$has_errors = set_error('assignment-subject', 'The subject field is required.');
    }

    if ($has_errors)
    {
        redirect('attendance-update', ['id' => $id]);
    }

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('attendance-list',['attendance-date' => $date,'attendance-subject' => $subject]);

?>
