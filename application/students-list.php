<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $students = get_all_students();
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Students</h6>
        <h3 class="text-center text-md-left">All Students</h3>
    </div>
</header>

<div class="row content">
    <div class="col">

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
                            <th scope="col">Course ID</th>
                            <th scope="col">Course Name</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
<?php while($row = mysqli_fetch_assoc($students)): ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['student-name']; ?></td>
                            <td><?php echo $row['surname']; ?></td>
                            <td><?php echo $row['course_id']; ?></td>
                            <td><?php echo $row['course-name']; ?></td>
                            <td>
                                <a href="subjects-edit.php?id=<?php echo $row['id']; ?>">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="subjects-delete.php?id=<?php echo $row['id']; ?>">
                                    <i class="icon fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

<?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<?php include 'template/footer.php'; ?>
