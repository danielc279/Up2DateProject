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
    $name       = $_POST['course-name'];
    $description = $_POST['course-desc'];
    $year       = $_POST['course-year'];
    $code       = $_POST['course-code'];

    // we'll use a boolean to determine if we have errors on the page.
    $has_errors = FALSE;

    // 4. check the inputs that are required.
    if (empty($name))
    {
    	$has_errors = set_error('course-name', 'The name field is required.');
    }

    if (empty($year))
    {
        $has_errors = set_error('course-year', 'Please choose a year.');
    }

    if (strlen($code) != 5)
    {
        $has_errors = set_error('course-code', 'Please enter a code that is 5 digits.');
    }

    if ($has_errors)
    {
        redirect('courses-add');
    }

    // 6. Insert the data in the table.
    // since the function will return a number, we can check it
    // to see if the query worked.
    $check = add_course($name, $description, $year, $code);
    if (!$check)
    {
        exit("The query was unsuccessful.");
    }

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('courses-list');

?>
