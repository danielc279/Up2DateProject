<?php
    include 'libraries/form.php';
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    // 1. Store the id for the show in a variable.
    $id = $_GET['id'];

    // 2. Get the information from the database.
    // if after I set $show, the value is FALSE:
    if (!$course = get_course($id))
    {
        exit("This course doesn't exist.");
    }

    // 4. only convert this data if there is nothing else on the server.
    if (!$formdata = get_formdata())
    {
        $formdata = to_formdata($course);
    }

    include 'template/header.php';
?>
<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Courses</h6>
        <h3 class="text-center text-md-left">Edit Course</h3>
    </div>
</header>

<form class="content" action="courses-edit-process.php" method="post">
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
            <input type="hidden" name="course-id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </div>
  </div>
</div>
</form>

<?php include 'template/footer.php'; ?>
