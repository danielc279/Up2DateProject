<?php
    include 'libraries/form.php';
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $id         = array_key_exists('id', $_COOKIE) ? $_COOKIE['id'] : FALSE;
    $subjects = get_subjects($id);

	// we can use a function to make this part easy.
    $formdata = get_formdata();
?>

<header class="page-header row no-gutters py-4">
    <div class="col-12">
        <h6 class="text-center text-md-left">Attendance</h6>
        <h3 class="text-center text-md-left">Specify Attendance</h3>
    </div>
</header>

<form class="content" action="attendance-update-process.php" method="post">
  <div class="rows">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
<?php if (has_error($formdata, 'attendance-date')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'attendance-date'); ?>
                </div>
<?php endif; ?>
                <input type="text" name="attendance-date" class="form-control mb-3" placeholder="Date (YYYY-MM-DD)"
                    value="<?php echo get_value($formdata, 'attendance-date'); ?>">
<?php if (has_error($formdata, 'attendance-subject')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'attendance-subject'); ?>
                </div>
<?php endif; ?>
                <div class="form-group row">
                    <label for="input-attendance-subject" class="col-sm-3 col-form-label">Subject:</label>
                        <div class="col-sm-9">
                            <select class="custom-select mb-3" name="attendance-subject" id="input-attendance-subject">
                                <option disabled selected>Select a Subject</option>
<?php while ($subject = mysqli_fetch_assoc($subjects)): ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name'];?></option>
<?php endwhile; ?>
                            </select>
                        </div>
                </div>
        </div>
    </div>
</div>

<div class="col-6 mt-3">
    <div class="card">
        <div class="card-body">
            <button type="submit" class="btn">Proceed</button>
        </div>
    </div>
</div>
</div>
</form>
<?php include 'template/footer.php'; ?>
