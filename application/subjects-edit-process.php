<?php
    // This file will be used to process the add channels form.
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
    $name         = $_POST['subject-name'];
    $course       = $_POST['subject-course'] ?: NULL;
    $instructor   = $_POST['subject-instructor'] ?: NULL;
    $description  = $_POST['subject-desc'];
    $id           = $_POST['subject-id'];

    // we'll use a boolean to determine if we have errors on the page.
    $has_errors = FALSE;

    // 4. check the inputs that are required.
    if (empty($name))
    {
    	$has_errors = set_error('subject-name', 'The name field is required.');
    }

	// 5. if there are errors, we should go back and channel them.
    if ($has_errors)
    {
        redirect('subjects-edit', ['id' => $id]);
    }

    $check = edit_subject($id, $name, $description, $course, $instructor);
    if (!$check)
    {
        exit("The record could not be updated!");
    }

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('subjects-list');

?>
