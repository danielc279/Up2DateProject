<?php
    include 'libraries/form.php';
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $courses = get_all_courses();

	// we can use a function to make this part easy.
    $formdata = get_formdata();
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Courses</h6>
        <h3 class="text-center text-md-left">New Course</h3>
    </div>
</header>

<form class="content" action="courses-add-process.php" method="post">
  <div class="rows">
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
<?php if (has_error($formdata, 'course-name')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'course-name'); ?>
                </div>
<?php endif; ?>
                <input type="text" name="course-name" class="form-control mb-3" placeholder="New Course"
                    value="<?php echo get_value($formdata, 'course-name'); ?>">
<?php if (has_error($formdata, 'course-desc')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'course-desc'); ?>
                </div>
<?php endif; ?>
                <textarea name="course-desc" rows="8" cols="80" placeholder="What are the details of this course?" class="form-control mb-3"><?php echo get_value($formdata, 'course-desc'); ?></textarea>

<?php if (has_error($formdata, 'course-year')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'course-year'); ?>
                </div>
<?php endif; ?>
                <div class="form-group row">
                    <label for="input-course-year" class="col-sm-3 col-form-label">Year:</label>
                    <div class="col-sm-9">
                        <select class="custom-select mb-3" name="course-year" id="input-course-year">
                            <option disabled selected>Choose an Year</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
<?php if (has_error($formdata, 'course-code')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'course-code'); ?>
                </div>
<?php endif; ?>
                <input type="text" name="course-code" class="form-control mb-3" placeholder="Enter a Code"
                    value="<?php echo get_value($formdata, 'course-code'); ?>">

            </div>
        </div>
    </div>
</div>

&nbsp;
<div class="rows">
  <div class="col-12 col-lg-3 mt-3 mt-lg-0">
      <div class="card">
          <div class="card-body">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </div>
  </div>
</div>
</form>
<?php include 'template/footer.php'; ?>
