<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';


    $date = $_GET['attendance-date'];
    $subject = $_GET['attendance-subject'];
    $count = 0;
    $attendances = get_attendance_list($subject);
?>

<header class="page-header row no-gutters py-4">
    <div class="col-12">
        <h6 class="text-center text-md-left">Attendance</h6>
        <h3 class="text-center text-md-left">Selected Attendance</h3>
    </div>
</header>

<form class="content" action="attendance-list-process.php" method="post">
<div class="row content">
    <div class="col-8 mx-auto">

        <div class="card">
            <div class="card-header border-bottom-0">
                <h6 class="m-0">Table</h6>
            </div>

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Attended?</th>
                        </tr>
                    </thead>
                    <tbody>
<?php while($attendance = mysqli_fetch_assoc($attendances)): ?>
                        <tr>
                          <input type="hidden" name="attendance-date" value="<?php echo $_GET['attendance-date'] ?>">
                          <input type="hidden" name="attendance-subject" value="<?php echo $_GET['attendance-subject'] ?>">
                            <td><?php echo $attendance['name']; ?></td>
                            <td><?php echo $attendance['surname']; ?></td>
                            <td>
                                <input type="hidden" name="attendance-id[<?php echo $attendance['user_id']; ?>]" value="<?php echo $attendance['user_id']; ?>">
                                <input type="radio" id="attended-<?php echo $attendance['user_id']; ?>" name="attendance-attended[<?php echo $attendance['user_id']; ?>]" value="1">
                                <input type="radio" id="not-attended-<?php echo $attendance['user_id']; ?>" name="attendance-attended[<?php echo $attendance['user_id']; ?>]" value="0" >
                            </td>
                            </td>
                        </tr>
<?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<div class="col-8 mt-3 mx-auto">
    <div class="card">
        <div class="card-body mx-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>


<?php include 'template/footer.php'; ?>
