<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';


    $date = $_GET['attendance-date'];
    $subject = $_GET['attendance-subject'];

    $attendances = get_attendance_list($subject);
?>

<header class="page-header row no-gutters py-4">
    <div class="col-12">
        <h6 class="text-center text-md-left">Assignments</h6>
        <h3 class="text-center text-md-left">All Assignments</h3>
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
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Attended?</th>
                        </tr>
                    </thead>
                    <tbody>
<?php while($attendance = mysqli_fetch_assoc($attendances)): ?>
                        <tr>
                            <td><?php echo $attendance['user_id']; ?></td>
                            <td><?php echo $attendance['name']; ?></td>
                            <td><?php echo $attendance['surname']; ?></td>
                            <td><input type="checkbox" id="attended" name="attended">
                            </td>
                        </tr>

<?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<div class="col-12 mt-3">
    <div class="card">
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>


<?php include 'template/footer.php'; ?>
