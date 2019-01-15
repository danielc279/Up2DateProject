<?php
  include '../libraries/http.php';
  include '../libraries/database.php';

  // 1. Check if we are using a POST request.
  ($_SERVER['REQUEST_METHOD'] === 'POST') or error();

  // 2. We can use a custom function to read the information
  // from the app.
  get_input_stream($data);
  $email      = isset($data['email']) ? $data['email'] : '';
  $password   = isset($data['password']) ? $data['password'] : '';
  $name   = isset($data['name']) ? $data['name'] : '';
  $surname   = isset($data['surname']) ? $data['surname'] : '';
  $code     = isset($data['code']) ? $data['code'] : '';
  $courseid = get_course_by_code($code);
  $role       = 3;
  // 3. check the inputs that are required.

  if (empty($email) || empty($password) || empty($name) || empty($surname))
  {
    error('Please fill all fields.');
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
      error('Please enter a valid email address.');
  }
  if (email_exists($email))
  {
      error('This email address is already registered.');
  }

  if (strlen($password) < 8)
  {
      error('Password must be at least 8 characters.');
  }
  if ($courseid == 0)
  {
      error('Not a valid code.');
  }
  $salt = random_code();

  # 6b. The function will hash the password and write it to the database.
  # If the query fails, we stop here.
  $id = register_login_data($email, $password, $salt, $role);
  if (!$id)
  {
      exit("You could not register.");
  }

  # 6c. Register the user details and check for errors.
  $check = register_user_details($id, $name, $surname);
  if (!$check)
  {
      exit("User not fully registered.");
  }

  # 6c. Register the user details and check for errors.
  $check = register_student($id, $courseid);
  if (!$check)
  {
      exit("User not fully registered.");
  }

  success();
?>
