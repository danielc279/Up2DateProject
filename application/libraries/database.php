<?php
    // Connects to the MySQL database.
    function connect()
    {
        // 1. Assign a new connection to a new variable.
        $link = mysqli_connect('localhost', 'root', '', 'db_up2date')
            or die('Could not connect to the database.');

        // 2. Give back the variable so we can always use it.
        return $link;
    }

    // Disconnects the website from the database.
    function disconnect(&$link)
    {
        mysqli_close($link);
    }


    // Add a new show to the table.
    function add_course($name, $description, $year, $code)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_courses
                (name, description, year, code)
            VALUES
                (?, ?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'ssis', $name, $description, $year, $code);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_insert_id($stmt);
    }

    // Checks that the information in a show has changed.
    function check_course($id, $name, $description, $year, $code)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $name = mysqli_real_escape_string($link, $name);
        $description = mysqli_real_escape_string($link, $description);
        $year = mysqli_real_escape_string($link, $year);
        $code = mysqli_real_escape_string($link, $code);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id
            FROM tbl_courses
            WHERE
                id = {$id} AND
                name = '{$name}' AND
                description = '{$description}' AND
                year = {$year} AND
                code = '{$code}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) == 1;
    }

    // Deletes a episode from the table.
    function delete_course($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            DELETE FROM tbl_courses
            WHERE id = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: integer
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Edit a show in the table.
    function edit_course($id, $name, $description, $year, $code)
    {
        if (check_course($id, $name, $description, $year, $code))
        {
            return TRUE;
        }

        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            UPDATE tbl_courses
            SET
                name = ?,
                description = ?,
                year = ?,
                code = ?
            WHERE
                id = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double integer
        mysqli_stmt_bind_param($stmt, 'ssisi', $name, $description, $year, $code, $id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Retrieves all the channels available in the database.
    function get_all_courses()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT *
            FROM tbl_courses
            ORDER BY id ASC
        ");

        echo mysqli_error($link);

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    // Retrieves all the channels available in the database.
    function get_all_students()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT
                a.user_id,
                a.course_id,
                b.name AS 'student-name',
                b.surname,
                c.name AS 'course-name'
            FROM
                tbl_students a
            LEFT JOIN
                tbl_user_details b
            ON
                a.user_id = b.user_id
            LEFT JOIN
                tbl_courses c
            ON
                a.course_id = c.id
        ");

        echo mysqli_error($link);

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    function get_all_courses_dropdown()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT id, name
            FROM tbl_courses
            ORDER BY name ASC
        ");

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    // Retrieves a single channel from the database.
    function get_course($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT
                name AS 'course-name',
                description AS 'course-desc',
                year AS 'course-year',
                code AS 'course-code'
            FROM tbl_courses
            WHERE id = {$id}
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_fetch_assoc($result) ?: FALSE;
    }

    // Add a new show to the table.
    function add_subject($name, $description, $course, $instructor)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_subjects
                (name, description, course_id, instructor_id)
            VALUES
                (?, ?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'ssii', $name, $description, $course, $instructor);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_insert_id($stmt);
    }

    // Checks that the information in a show has changed.
    function check_subject($id, $name, $description, $course, $instructor)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $name = mysqli_real_escape_string($link, $name);
        $description = mysqli_real_escape_string($link, $description);
        $course = mysqli_real_escape_string($link, $course);
        $instructor = mysqli_real_escape_string($link, $instructor);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id
            FROM tbl_subjects
            WHERE
                id = {$id} AND
                name = '{$name}' AND
                description = '{$description}' AND
                course_id = {$course} AND
                instructor_id = {$instructor}
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) == 1;
    }

    // Deletes a episode from the table.
    function delete_subject($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            DELETE FROM tbl_subjects
            WHERE id = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: integer
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Edit a show in the table.
    function edit_subject($id, $name, $description, $course, $instructor)
    {
        if (check_subject($id, $name, $description, $course, $instructor))
        {
            return TRUE;
        }

        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            UPDATE tbl_subjects
            SET
                name = ?,
                description = ?,
                course_id = ?,
                instructor_id = ?
            WHERE
                id = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double integer
        mysqli_stmt_bind_param($stmt, 'ssiii', $name, $description, $course, $instructor, $id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Retrieves all the channels available in the database.
    function get_all_subjects()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT *
            FROM tbl_subjects
            ORDER BY id ASC
        ");

        echo mysqli_error($link);

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    function get_all_subjects_dropdown()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT id, name
            FROM tbl_subjects
            ORDER BY name ASC
        ");

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    // Retrieves a single channel from the database.
    function get_subject($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT
                name AS 'subject-name',
                description AS 'subject-desc',
                course_id AS 'subject-course',
                instructor_id AS 'subject-instructor'
            FROM tbl_subjects
            WHERE id = {$id}
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_fetch_assoc($result) ?: FALSE;
    }

    // Add a new show to the table.
    function add_assignment($subject, $name, $duedate, $description, $points)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_assignments
                (subject_id, name, due_date, description, points)
            VALUES
                (?, ?, ?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'isisi', $subject, $name, $duedate, $description, $points);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.

        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_insert_id($stmt);
    }

    // Checks that the information in a show has changed.
    function check_assignment($id, $subject, $name, $duedate, $description, $points)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $subject = mysqli_real_escape_string($link, $subject);
        $name = mysqli_real_escape_string($link, $name);
        $duedate = mysqli_real_escape_string($link, $duedate);
        $description = mysqli_real_escape_string($link, $description);
        $points = mysqli_real_escape_string($link, $points);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id
            FROM tbl_assignments
            WHERE
                id = {$id} AND
                subject_id = '{$subject}' AND
                name = '{$name}' AND
                due_date = {$duedate} AND
                description = {$description} AND
                points = {$points}
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) == 1;
    }

    // Deletes a episode from the table.
    function delete_assignment($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            DELETE FROM tbl_assignments
            WHERE id = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: integer
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Edit a show in the table.
    function edit_assignment($id, $subject, $name, $duedate, $description, $points)
    {
        if (check_assignment($id, $subject, $name, $duedate, $description, $points))
        {
            return TRUE;
        }

        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            UPDATE tbl_assignments
            SET
                subject_id = ?,
                name = ?,
                due_date = ?,
                description = ?,
                points = ?
            WHERE
                id = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double integer
        mysqli_stmt_bind_param($stmt, 'isisii', $subject, $name, $duedate, $description, $points, $id);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Retrieves all the channels available in the database.
    function get_all_assignments_student($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT a.*
            FROM
                tbl_assignments a
            LEFT JOIN
                tbl_subjects b
            ON
                a.subject_id = b.id
            LEFT JOIN
                tbl_students c
            ON
                b.course_id = c.course_id
            WHERE
                c.user_id = {$id}
            ORDER BY id ASC
        ");

        echo mysqli_error($link);

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    <?php
    include '../libraries/database.php';
    include '../libraries/http.php';

    ($_SERVER['REQUEST_METHOD'] === 'GET') or error();
    check_login_auth() or error("You have no permission to be here.");

    $shows = get_all_shows();
    success('shows', mysqli_fetch_all($shows, MYSQLI_ASSOC));
?>


    function get_all_assignments_dropdown()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Retrieve all the rows from the table.
        $result = mysqli_query($link, "
            SELECT id, name
            FROM tbl_assignments
            ORDER BY name ASC
        ");

        // 3. Disconnect from the database.
        disconnect($link);

        // 4. Return the result set.
        return $result;
    }

    // Retrieves a single channel from the database.
    function get_assignment($id)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT
                subject_id AS 'assignment-subject',
                name AS 'assignment-name',
                due_date AS 'assignment-duedate',
                description AS 'assignment-desc',
                points AS 'assignment-points'
            FROM tbl_assignments
            WHERE id = {$id}
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_fetch_assoc($result) ?: FALSE;
    }

    // Checks that the userdata is valid
    function check_api_auth($id, $auth)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $auth_code = mysqli_real_escape_string($link, $auth_code);
        $expiration = mysqli_real_escape_string($link, time());

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT user_id
            FROM tbl_user_auth
            WHERE
                user_id = {$id} AND
                auth_code = '{$auth_code}' AND
                expiration > {$expiration}
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) == 1;
    }

    function check_password($email, $password)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $email = mysqli_real_escape_string($link, $email);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id, password, salt, role_id
            FROM tbl_users
            WHERE email = '{$email}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. If no record exists, we can stop here.
        if (!$record = mysqli_fetch_assoc($result))
        {
            return FALSE;
        }

        // 6. We can check that the password matches what is on record.
        $password = $record['salt'].$password;
        if (!password_verify($password, $record['password']))
        {
            return FALSE;
        }

        // 7. all is fine
        return array('id' => $record['id'], 'role' => $record['role_id']);
    }

    // Clears the login data from a table.
    function clear_login_data($id, $auth_code)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            DELETE FROM tbl_user_auth
            WHERE user_id = ? AND auth_code = ?
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: integer string
        mysqli_stmt_bind_param($stmt, 'is', $id, $auth);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have changed one row.
        return mysqli_stmt_affected_rows($stmt) == 1;
    }

    // Checks if an email is already registered.
    function email_exists($email)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $email = mysqli_real_escape_string($link, $email);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id
            FROM tbl_users
            WHERE email = '{$email}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) >= 1;
    }

    // Retrieves the login data for a user.
    function get_login_data($id, $ip_address)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $ip_address = mysqli_real_escape_string($link, $ip_address);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT
                a.id,
                a.email,
                a.role_id,
                b.name,
                b.surname,
                c.auth_code,
                c.expiration
            FROM
                tbl_users a
            LEFT JOIN
                tbl_user_details b
            ON
                a.id = b.user_id
            LEFT JOIN
                tbl_user_auth c
            ON
                a.id = c.user_id

            WHERE
                a.id = {$id} AND c.ip_address = '{$ip_address}'
        ");

        // 4. Disconnect from the database.
        disconnect($link);

        // 5. There should only be one row, or FALSE if nothing.
        return mysqli_fetch_assoc($result) ?: FALSE;
    }

    // Checks that a user is logged into the system
    function is_logged()
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. we'll need the information from the cookies.
        $id         = array_key_exists('id', $_COOKIE) ? $_COOKIE['id'] : 0;
        $auth_code  = array_key_exists('auth_code', $_COOKIE) ? $_COOKIE['auth_code'] : '';

        // 3. Protect variables to avoid any SQL injection
        $id = mysqli_real_escape_string($link, $id);
        $auth_code = mysqli_real_escape_string($link, $auth_code);
        $expiration = mysqli_real_escape_string($link, time());

        // 4. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT user_id
            FROM tbl_user_auth
            WHERE
                user_id = {$id} AND
                auth_code = '{$auth_code}' AND
                expiration > {$expiration}
        ");

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. There should only be one row, or FALSE if nothing.
        return mysqli_num_rows($result) == 1;
    }

    // Writes the new login data to the auth table.
    function set_login_data($id, $code, $ip_address, $expiration)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_user_auth
                (user_id, auth_code, ip_address, expiration)
            VALUES
                (?, ?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'issi', $id, $code, $ip_address, $expiration);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_affected_rows($stmt);
    }

	  // generates a random code
	  function random_code($limit = 8)
	  {
	      return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
	  }

    // Registers a user's login data.
    function register_login_data($email, $password, $salt, $role)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. protect the password using blowfish.
        $password = password_hash($salt.$password, CRYPT_BLOWFISH);
        $creationdate = time();

        // 3. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_users
                (email, password, salt, creation_date, role_id)
            VALUES
                (?, ?, ?, ?, ?)
        ");

        // 4. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'sssii', $email, $password, $salt, $creationdate, $role);

        // 5. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 6. Disconnect from the database.
        disconnect($link);

        // 7. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_insert_id($stmt);
    }

    // Registers a user's login data.
    function register_user_details($id, $name, $surname)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_user_details
                (user_id, name, surname)
            VALUES
                (?, ?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'iss', $id, $name, $surname);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_affected_rows($stmt);
    }

    function register_student($id, $courseid)
    {
        // 1. Connect to the database.
        $link = connect();

        // 2. Prepare the statement using mysqli
        // to take care of any potential SQL injections.
        $stmt = mysqli_prepare($link, "
            INSERT INTO tbl_students
                (user_id, course_id)
            VALUES
                (?, ?)
        ");

        // 3. Bind the parameters so we don't have to do the work ourselves.
        // the sequence means: string string double integer double
        mysqli_stmt_bind_param($stmt, 'ii', $id, $courseid);

        // 4. Execute the statement.
        mysqli_stmt_execute($stmt);

        // 5. Disconnect from the database.
        disconnect($link);

        // 6. If the query worked, we should have a new primary key ID.
        return mysqli_stmt_affected_rows($stmt);
    }

    function get_instructors()
    {

      $link = connect();

      // 3. Generate a query and return the result.
      $result = mysqli_query($link, "
          SELECT *
          FROM
              tbl_users a
          LEFT JOIN
              tbl_user_details b
          ON
              a.id = b.user_id
          WHERE
              a.role_id = 2
          ORDER BY name ASC
      ");

      echo mysqli_error($link);

      // 3. Disconnect from the database.
      disconnect($link);

      // 4. Return the result set.
      return $result;
    }

    function get_subjects($id)
    {

      $link = connect();

      // 3. Generate a query and return the result.
      $result = mysqli_query($link, "
          SELECT *
          FROM
              tbl_subjects
          WHERE
              instructor_id = {$id}
          ORDER BY name ASC
      ");

      echo mysqli_error($link);

      // 3. Disconnect from the database.
      disconnect($link);

      // 4. Return the result set.
      return $result;
    }

    // Retrieves a single channel from the database.
    function get_course_by_code($code)
    {
        // 1. Connect to the database.
        $link = connect();

        $code = mysqli_real_escape_string($link, $code);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT id
            FROM tbl_courses
            WHERE code = '{$code}'
        ");

        echo mysqli_error($link);

        // 4. Disconnect from the database.
        disconnect($link);

        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }

        // 5. There should only be one row, or FALSE if nothing.
        return FALSE;
    }

    // Retrieves a single channel from the database.
    function is_student($id)
    {
        // 1. Connect to the database.
        $link = connect();

        $code = mysqli_real_escape_string($link, $code);

        // 3. Generate a query and return the result.
        $result = mysqli_query($link, "
            SELECT
                role_id
            FROM tbl_users
            WHERE id = {$id}
        ");

        echo mysqli_error($link);

        // 4. Disconnect from the database.
        disconnect($link);

        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['role_id'];
        }

        // 5. There should only be one row, or FALSE if nothing.
        return FALSE;
    }
?>
