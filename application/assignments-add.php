<?php
    include 'libraries/form.php';
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $id         = array_key_exists('id', $_COOKIE) ? $_COOKIE['id'] : FALSE;
    $assignments = get_all_assignments($id);
    $subjects = get_subjects($id);

	// we can use a function to make this part easy.
    $formdata = get_formdata();
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Assignments</h6>
        <h3 class="text-center text-md-left">New Assignment</h3>
    </div>
</header>

<form class="content" action="assignments-add-process.php" method="post">
  <div class="rows">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
<?php if (has_error($formdata, 'assignment-name')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'assignment-name'); ?>
                </div>
<?php endif; ?>
                <input type="text" name="assignment-name" class="form-control mb-3" placeholder="New Assignment"
                    value="<?php echo get_value($formdata, 'assignment-name'); ?>">
<?php if (has_error($formdata, 'assignment-subject')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'assignment-subject'); ?>
                </div>
<?php endif; ?>
                <div class="form-group row">
                    <label for="input-assignment-subject" class="col-sm-3 col-form-label">Subject:</label>
                        <div class="col-sm-9">
                            <select class="custom-select mb-3" name="assignment-subject" id="input-assignment-subject">
                                <option disabled selected>Select a Subject</option>
<?php while ($subject = mysqli_fetch_assoc($subjects)): ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name'];?></option>
<?php endwhile; ?>
                            </select>
                        </div>
                </div>
<?php if (has_error($formdata, 'assignment-desc')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'assignment-desc'); ?>
                </div>
<?php endif; ?>
                <textarea name="assignment-desc" rows="8" cols="80" placeholder="What are the details of this assignment?" class="form-control mb-3"><?php echo get_value($formdata, 'assignment-desc'); ?></textarea>
<?php if (has_error($formdata, 'assignment-duedate')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'assignment-duedate'); ?>
                </div>
<?php endif; ?>
                <input type="number" name="assignment-duedate" class="form-control mb-3" placeholder="Due Date"
                    value="<?php echo get_value($formdata, 'assignment-duedate'); ?>">
<?php if (has_error($formdata, 'assignment-points')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'assignment-points'); ?>
                </div>
<?php endif; ?>
                <input type="number" name="assignment-points" class="form-control mb-3" placeholder="Points"
                    value="<?php echo get_value($formdata, 'assignment-points'); ?>">
        </div>
    </div>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-body">
          <input type="hidden" name="assignment-id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</div>
</form>
<?php include 'template/footer.php'; ?>
