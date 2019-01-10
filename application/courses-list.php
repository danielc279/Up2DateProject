<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $courses = get_all_courses();
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Courses</h6>
        <h3 class="text-center text-md-left">All Courses</h3>
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
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Year</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
<?php while($row = mysqli_fetch_assoc($courses)): ?>
                        <tr>
                            <td><span class="counter"></span></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                            <td>
                                <a href="courses-edit.php?id=<?php echo $row['id']; ?>">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="courses-delete.php?id=<?php echo $row['id']; ?>">
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
