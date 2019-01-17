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

    $attendances = get_attendance_list($subject);

    // 3. retrieve the variables from $_POST.
for($i = 0; $attendance[] = mysqli_fetch_assoc($attendances); $i++)
{
    $userid   = $_POST['attendance-id'][$i];
    $attended = isset($_POST["attendance-attended"][$i]) ? 1 : 0;
    // we'll use a boolean to determine if we have errors on the page.
    $has_errors = FALSE;

    if ($has_errors)
    {
        redirect('attendence-update');
    }

    echo $date;
    echo " ";
    echo $subject;
    echo $userid;
    echo $attended;
    // 6. Insert the data in the table.
    // since the function will return a number, we can check it
    // to see if the query worked.
    $result = mysql_query("
        INSERT tbl_attendance
            (date, subject_id, user_id, attended)
        VALUES ('$_POST[attendance-date]', '$_POST[attendance-subject]', '$_POST[attendance-id]', '$_POST[attendance-attended]');");
        if (!$result) {
            echo "Something went wrong!";
        }
    $check = add_attendance($date, $subject, $userid, $attended);
    if (!$check)
    {
        exit("The query was unsuccessful.");
    }
}

    // 7. Everything worked, go back to the list.
    clear_formdata();
    redirect('attendance-update');

?>
