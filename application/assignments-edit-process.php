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
    $subject    = $_POST['assignment-subject'];
    $name       = $_POST['assignment-name'];
    $duedate    = $_POST['assignment-duedate'];
    $description = $_POST['assignment-desc'];
    $points       = $_POST['assignment-points'];
    $id           = $_POST['assignment-id'];

    // we'll use a boolean to determine if we have errors on the page.
    $has_errors = FALSE;

    // 4. check the inputs that are required.
    if (empty($name))
    {
    	$has_errors = set_error('assignment-name', 'The name field is required.');
    }

    if (empty($subject))
    {
    	$has_errors = set_error('assignment-subject', 'The subject field is required.');
    }

    if (strlen($points) > 5)
    {
        $has_errors = set_error('assignment-points', 'Assignment must be worth at least 5 points.');
    }

    if ($has_errors)
    {
        redirect('assignments-edit', ['id' => $id]);
    }

    // 6. Insert the data in the table.
    // since the function will return a number, we can check it
    // to see if the query worked.
    $check = edit_assignment($id, $subject, $name, $duedate, $description, $points);
    if (!$check)
    {
        exit("The query was unsuccessful.");
    }

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('assignments-list');

?>
