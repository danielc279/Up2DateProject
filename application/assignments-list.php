<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $id         = array_key_exists('id', $_COOKIE) ? $_COOKIE['id'] : FALSE;
    $assignments = get_all_assignments($id);
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Assignments</h6>
        <h3 class="text-center text-md-left">All Assignments</h3>
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
                            <th scope="col">Subject</th>
                            <th scope="col">Name</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Description</th>
                            <th scope="col">Points</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
<?php while($row = mysqli_fetch_assoc($assignments)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['subject_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['due_date']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['points']; ?></td>
                            <td>
                                <a href="assignments-edit.php?id=<?php echo $row['id']; ?>">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
                                <a href="assignments-delete.php?id=<?php echo $row['id']; ?>">
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
