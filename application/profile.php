<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $students = get_all_students();
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h3 class="text-center text-md-left">Profile</h3>
    </div>
</header>

<div class="row content">
    <div class="col">
                                <a href="shows-edit.php?id=<?php echo $row['id']; ?>">
                                    <i class="icon fas fa-pencil-alt"></i>
                                </a>
    </div>
</div>


<?php include 'template/footer.php'; ?>
