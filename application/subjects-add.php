<?php
    include 'libraries/form.php';
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $courses = get_all_courses();
    $instructors = get_instructors();

	// we can use a function to make this part easy.
    $formdata = get_formdata();
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h6 class="text-center text-md-left">Subjects</h6>
        <h3 class="text-center text-md-left">New Subjects</h3>
    </div>
</header>

<form class="content mt-4" action="subjects-add-process.php" method="post">
  <div class="rows">
    <div class="col-8 ">
        <div class="card">
            <div class="card-body">
<?php if (has_error($formdata, 'subject-name')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'subject-name'); ?>
                </div>
<?php endif; ?>
                <input type="text" name="subject-name" class="form-control mb-3" placeholder="New Subject"
                    value="<?php echo get_value($formdata, 'subject-name'); ?>">
<?php if (has_error($formdata, 'subject-desc')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'subject-desc'); ?>
                </div>
<?php endif; ?>
                <textarea name="subject-desc" rows="8" cols="80" placeholder="What are the details of this subject?" class="form-control mb-3"><?php echo get_value($formdata, 'subject-desc'); ?></textarea>

<?php if (has_error($formdata, 'subject-course')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'subject-course'); ?>
                </div>
<?php endif; ?>
                <div class="form-group row">
                    <label for="input-subject-course" class="col-sm-3 col-form-label">Course:</label>
                        <div class="col-sm-9">
                            <select class="custom-select mb-3" name="subject-course" id="input-subject-course">
                                <option disabled selected>Choose a Course</option>
<?php while ($course = mysqli_fetch_assoc($courses)): ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['name'], ' ', $course['year'];?></option>

<?php endwhile; ?>
                            </select>
                        </div>
                </div>
<?php if (has_error($formdata, 'subject-instructor')): ?>
                <div class="alert-danger mb-3 p-3">
                    <?php echo get_error($formdata, 'subject-instructor'); ?>
                </div>
<?php endif; ?>
                <div class="form-group row">
                    <label for="input-subject-instructor" class="col-sm-3 col-form-label">Course:</label>
                        <div class="col-sm-9">
                            <select class="custom-select mb-3" name="subject-instructor" id="input-subject-instructor">
                                <option disabled selected>Select an Instructor</option>
<?php while ($instructor = mysqli_fetch_assoc($instructors)): ?>
                                <option value="<?php echo $instructor['id']; ?>"><?php echo $instructor['name'], ' ', $instructor['surname'];?></option>

<?php endwhile; ?>
                            </select>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

&nbsp;
<div class="rows">
  <div class="col-8">
      <div class="card">
          <div class="card-body">
              <button type="submit" class="btn">Submit</button>
          </div>
      </div>
  </div>
</div>
</form>
<?php include 'template/footer.php'; ?>
