<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';


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
                </table>
            </div>
        </div>

    </div>
</div>


<?php include 'template/footer.php'; ?>
