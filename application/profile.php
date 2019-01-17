<?php
    include 'libraries/form.php';
    include 'libraries/database.php';
    include 'libraries/login-check.php';


    // 1. Store the id for the show in a variable.
    $id = array_key_exists('id', $_COOKIE) ? $_COOKIE['id'] : FALSE;
    $subjects = get_subjects($id);
    $user = get_user($id);
    $subjects = get_subjects($id);
    // 2. Get the information from the database.
    // if after I set $show, the value is FALSE:
    if (!$assignment = get_assignment($id))
    {
        exit("This assignment doesn't exist.");
    }

    // 4. only convert this data if there is nothing else on the server.
    if (!$formdata = get_formdata())
    {
        $formdata = to_formdata($assignment);
    }

    include 'template/header.php';
?>
<div class="col-3 border-bottom">
  <div class="row my-4">
    <div class="">
        <img class="mx-4" height="80" width="80" src="images/user.png" alt="Up2Date">
    </div>
    <div class="">
      <h3 class="text-left text-md-left my-4"><?php echo $user['name'], ' ', $user['surname']; ?></h3>
    </div>
  </div>


</div>

<div class="col-4">
  <div class="row mx-2 my-4">
    <div class="">
      <h6 class="text-left "><?php echo $user['bio']; ?>
          <a href="profile-edit.php?id=<?php echo $id;  ?>">
              <i class="icon fas fa-pencil-alt"></i>
          </a>
      </h6>
    </div>
</div>

</div>
<div class="row content mt-4">
  <div class="col-4 mx-2">
        <div class="card">

            <div class="card-body p-0 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Subjects</th>
                            <th scope="col">Course</th>
                        </tr>
                    </thead>
                    <tbody>
<?php while ($subject = mysqli_fetch_assoc($subjects)): ?>
                        <tr>
                            <td><?php echo $subject['name']; ?></td>
                            <td><?php echo $subject['course_id']; ?></td>
                        </tr>

<?php endwhile; ?>
                    </tbody>
                </table>
        </div>
      </div>
    </div>
</div>








<?php include 'template/footer.php'; ?>
